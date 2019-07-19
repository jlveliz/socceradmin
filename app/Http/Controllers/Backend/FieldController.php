<?php

namespace Futbol\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Futbol\Http\Controllers\Controller;
use Futbol\RepositoryInterface\FieldRepositoryInterface;
use Futbol\RepositoryInterface\AgeRangeRepositoryInterface;
use Futbol\RepositoryInterface\FieldTypeRepositoryInterface;
use Futbol\RepositoryInterface\CoachRepositoryInterface;
use Futbol\Http\Requests\FieldRequest;
use Futbol\Exceptions\FieldException;
use Exception;
use DB;

class FieldController extends Controller
{
    
    protected $field;
    protected $ageRange;
    protected $ftype;
    protected $coach;

    protected $routeRedirectIndex = 'fields.index';


    function __construct(FieldRepositoryInterface $field, AgeRangeRepositoryInterface $ageRange, FieldTypeRepositoryInterface $ftype, CoachRepositoryInterface $coach)
    {
        $this->middleware('auth',['except' => 'getSchedule']);
        $this->field = $field;
        $this->ageRange = $ageRange;
        $this->ftype = $ftype;
        $this->coach = $coach;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fields = $this->field->enum();
        return view('backend.field.index',compact('fields'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $daysOfWeek = days_of_week();
        $types = $this->ftype->enum();
        return view('backend.field.create-edit',compact('daysOfWeek','types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FieldRequest $request)
    {
        $message = [
            'type' => 'success',
            'content' =>'',
        ];

        //begin transaction
        DB::beginTransaction();


        try {
            $message['content'] = "Se ha creado la cancha Satisfactoriamente";
            $field = $this->field->save($request->all());
            DB::commit();
            if ($request->get('redirect-index') == 1) {
                return redirect()->route($this->routeRedirectIndex)->with($message);
            } else {
                return redirect()->route('fields.edit',['id'=>$field->id])->with($message);
            }
        } catch (FieldException $e) {
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
        if ($request->ajax()) {

            try {
                $field = $this->field->find($id);
                return response($field,200);
                
            } catch (FieldException $e) {
                return response($e->getMessage(),$e->getCode());
                
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $field = $this->field->find($id);
        $aRanges = $this->ageRange->enum();
        $types = $this->ftype->enum();
        $daysOfWeek = days_of_week();
        $coachs = $this->coach->enum(['state' => 1]);
        return view('backend.field.create-edit',compact('field','daysOfWeek','aRanges','types','coachs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FieldRequest $request, $id)
    {
        $message = [
            'type' => 'success',
            'content' =>'',
        ];
        DB::beginTransaction();
        try {

            if($request->has('remove-schedule')) {
                dd($request->all());
            }
            
            $field = $this->field->edit($id,$request->all());
            DB::commit();
            $message['content'] = "Se ha Actualizado la cancha satisfactoriamente";
            
          if ($request->get('redirect-index') == 1) { 
            return redirect()->route($this->routeRedirectIndex)->with($message);
          } else {
            return back()->with($message);
          }
          
        } catch (FieldException $e) {
            DB::rollback();
            $message['type'] = 'error';
            $message['content'] = $e->getMessage();
        } catch (Exception $e) {
            DB::rollback();
            $message['type'] = "error";
            $message['content'] = $e->getMessage();
            return back()->with($message);
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
        DB::beginTransaction();
        try {
            $deleted = $this->field->remove($id);
            DB::commit();
            $message['content'] = "Se ha eliminado la cancha satisfactoriamente";
            return back()->with($message);
        } catch (FieldException $e) {
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
    public function getSchedule($id , Request $request) {
        
        if ($request->ajax()) {
            
            $schedule = $this->field->findSchedule($id);

            if($schedule) {
                return response($schedule,200);
            } else {    
                return response('no encontrado',404);
            }


        }

        return response('no permitido',401);
    }
}
