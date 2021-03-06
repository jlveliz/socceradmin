<?php

namespace Futbol\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Futbol\Http\Controllers\Controller;
use Futbol\RepositoryInterface\AssistanceRepositoryInterface;
use Futbol\RepositoryInterface\FieldRepositoryInterface;
use Futbol\RepositoryInterface\GroupClassRepositoryInterface;
use Futbol\RepositoryInterface\SeasonRepositoryInterface;
use Futbol\Http\Requests\AssistanceRequest;
use Futbol\Exceptions\AssistanceException;
use DB;
use Exception;

class AssistanceController extends Controller
{
    
    protected $assistance;
    protected $field;
    protected $grClass;
    protected $seasonRepo;

    protected $routeRedirectIndex = 'assistances.index';


    function __construct(AssistanceRepositoryInterface $assistance, FieldRepositoryInterface $field, GroupClassRepositoryInterface $grClass, SeasonRepositoryInterface $seasonRepo)
    {
        $this->middleware('auth');
        $this->assistance = $assistance;
        $this->field = $field;
        $this->grClass = $grClass;
        $this->seasonRepo = $seasonRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fields = $this->field->enum();
        $currentSeason = $this->seasonRepo->getActive();
        
        if ($request->has('paginate')) {
            $assistances = $this->assistance->enum();
            return view('backend.assistance.index',compact('assistances','fields'));
        } else {

            if ($request->has('field')) {
                $days = $this->field->find($request->get('field'))->available_days;
            } else {
                $days = [];
            }
            if ($request->has('key_day')) {
                $groups = $this->grClass->findByFieldAndDay($request->get('field'),$request->get('key_day'));
            } else {
                $groups = [];
            }

            if ($request->has('group_id')) {
                $months = $this->seasonRepo->getMonthForSeason($currentSeason->id);
            } else {
                $months = [];
            }

            if ($request->has('field') && $request->has('key_day') && $request->has('group_id') && $request->has('month')) {
                $assistances = $this->assistance->getAssistanceByGroup($request->all());
            } else {
                $assistances = [];
            }

            return view('backend.assistance.index',compact('assistances','fields','days','groups','currentSeason','months'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.assistance.create-edit',compact('daysOfWeek'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssistanceRequest $request)
    {
        $message = [
            'type' => 'success',
            'content' =>'',
        ];
        
        //begin transaction
        DB::beginTransaction();
        try {
            $message['content'] = "Se han guardado las asistencias Satisfactoriamente";
            $assistance = $this->assistance->saveMany($request->get('assistances'));
            DB::commit();
            return back()->with($message);
        } catch (AssistanceException $e) {
            DB::rollback();
            $message['type'] = "error";
            $message['content'] = $e->getMessage();
            return back()->with($message);
        } catch (Exception $e) {
            DB::rollback();
            $message['type'] = "error";
            $message['content'] = $e->getMessage();
            return back()->with($message);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $assistance = $this->assistance->find($id);
        $aRanges = $this->ageRange->enum();
        $daysOfWeek = days_of_week();
        return view('backend.assistance.create-edit',compact('assistance','daysOfWeek','aRanges'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AssistanceRequest $request, $id)
    {
        $message = [
            'type' => 'success',
            'content' =>'',
        ];
        try {

            if($request->has('remove-schedule')) {
                dd($request->all());
            }
            
            $assistance = $this->assistance->edit($id,$request->all());
            $message['content'] = "Se ha Actualizado la cancha satisfactoriamente";
            
          if ($request->get('redirect-index') == 1) { 
            return redirect()->route($this->routeRedirectIndex)->with($message);
          } else {
            return back()->with($message);
          }
          
        } catch (AssistanceException $e) {
            $message['type'] = 'error';
            $message['content'] = $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = [
            'type' => 'success',
            'content' =>'',
        ];
        try {
            $deleted = $this->assistance->remove($id);
            $message['content'] = "Se ha eliminado la cancha satisfactoriamente";
            return back()->with($message);
        } catch (AssistanceException $e) {
            $message['type'] = "error";
            $message['content'] = $e->getMessage();
            return back()->with($message);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getSchedule($id , Request $request) {
        
        if ($request->ajax()) {
            
            $schedule = $this->assistance->findSchedule($id);

            if($schedule) {
                return response($schedule,200);
            } else {    
                return response('no encontrado',404);
            }


        }

        return response('no permitido',401);
    }
}
