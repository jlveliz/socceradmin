<?php

namespace Futbol\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Futbol\Http\Controllers\Controller;
use Futbol\RepositoryInterface\AssistanceCoachRepositoryInterface;
use Futbol\RepositoryInterface\FieldRepositoryInterface;
use Futbol\RepositoryInterface\CoachRepositoryInterface;
use Futbol\Http\Requests\AssistanceCoachRequest;
use Futbol\Exceptions\AssistanceCoachException;
use DB;

class AssistanceCoachController extends Controller
{
    
    protected $assistance;
    protected $coach;
    protected $field;
    
    protected $routeRedirectIndex = 'assistances.index';


    function __construct(AssistanceCoachRepositoryInterface $assistance, CoachRepositoryInterface $coach, FieldRepositoryInterface $field)
    {
        $this->middleware('auth');
        $this->assistance = $assistance;
        $this->coach = $coach;
        $this->field = $field;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coachs = $this->coach->enum();
        $fields = $this->field->enum();
        return view('backend.assistance-coach.index', compact('fields','coachs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.assistance.create-edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssistanceCoachRequest $request)
    {
        $message = [
            'type' => 'success',
            'content' =>'',
        ];
        //begin transaction
        DB::beginTransaction();
        try {
            $message['content'] = "Se han guardado la asistencia Satisfactoriamente";
            $assistance = $this->assistance->save($request->all());
            DB::commit();
            return back()->with($message);
        } catch (AssistanceCoachException $e) {
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
    public function update(AssistanceCoachRequest $request, $id)
    {
        $message = [
            'type' => 'success',
            'content' =>'',
        ];
        try {
            $assistance = $this->assistance->edit($id,$request->all());
            $message['content'] = "Se ha Actualizado la asistencia satisfactoriamente";
            
          if ($request->get('redirect-index') == 1) { 
            return redirect()->route($this->routeRedirectIndex)->with($message);
          } else {
            return back()->with($message);
          }
          
        } catch (AssistanceCoachException $e) {
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
        } catch (AssistanceCoachException $e) {
            $message['type'] = "error";
            $message['content'] = $e->getMessage();
            return back()->with($message);
        }
    }


    public function loadDaysMonth(Request $request)
    {
        try {
           if ($request->ajax()) {
                $monthSelected = $request->get('month');
                $fieldId = $request->get('field');
                $coachsId = $request->get('coachs');
                $days = $this->assistance->loadDaysMonth($monthSelected,$fieldId, $coachsId);
                return response($days,200);
           } 
        } catch (Exception $e) {
            
        }
    }
}
