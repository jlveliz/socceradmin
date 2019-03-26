<?php

namespace HappyFeet\Http\Controllers\Backend;

use Illuminate\Http\Request;
use HappyFeet\Http\Controllers\Controller;
use HappyFeet\RepositoryInterface\AssistanceCoachCoachRepositoryInterface;
use HappyFeet\Http\Requests\AssistanceCoachRequest;
use HappyFeet\Exceptions\AssistanceCoachException;


class AssistanceCoachController extends Controller
{
    
    protected $assistance;
    
    protected $routeRedirectIndex = 'assistances.index';


    function __construct(AssistanceCoachRepositoryInterface $assistance)
    {
        $this->middleware('auth');
        $this->assistance = $assistance;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('backend.assistance-coach.index');
        

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
            'type' => 'primary',
            'content' =>'',
        ];
        
        //begin transaction
        DB::beginTransaction();
        try {
            $message['content'] = "Se han guardado las asistencias Satisfactoriamente";
            $assistance = $this->assistance->save($request->get('assistances'));
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
            'type' => 'primary',
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
            'type' => 'primary',
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
