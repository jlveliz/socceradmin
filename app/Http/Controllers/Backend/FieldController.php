<?php

namespace HappyFeet\Http\Controllers\Backend;

use Illuminate\Http\Request;
use HappyFeet\Http\Controllers\Controller;
use HappyFeet\RepositoryInterface\FieldRepositoryInterface;
use HappyFeet\Http\Requests\FieldRequest;
use HappyFeet\Exceptions\FieldException;

class FieldController extends Controller
{
    
    protected $field;

    protected $routeRedirectIndex = 'fields.index';


    function __construct(FieldRepositoryInterface $field)
    {
        $this->middleware('auth');
        $this->field = $field;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fields = $this->field->paginate();
        return view('backend.field.index',compact('fields'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.field.create-edit');
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
            'type' => 'primary',
            'content' =>'',
        ];

        try {
            $message['content'] = "Se ha creado la cancha Satisfactoriamente";
            $field = $this->field->save($request->all());
            if ($request->get('redirect-index') == 1) {
                return redirect()->route($this->routeRedirectIndex)->with($message);
            } else {
                return redirect()->route('fields.edit',['id'=>$field->id])->with($message);
            }
        } catch (FieldException $e) {
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
    public function show($id)
    {
        //
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
        return view('backend.field.create-edit',compact('field'));
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
            'type' => 'primary',
            'content' =>'',
        ];
        try {
          $field = $this->field->edit($id,$request->all());
          $message['content'] = "Se ha Actualizado la cancha satisfactoriamente";
          
          if ($request->get('redirect-index') == 1) { 
            return redirect()->route($this->routeRedirectIndex)->with($message);
          } else {
            return back()->with($message);
          }
          
        } catch (FieldException $e) {
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
            $deleted = $this->field->remove($id);
            $message['content'] = "Se ha eliminado la cancha satisfactoriamente";
            return back()->with($message);
        } catch (FieldException $e) {
            $message['type'] = "error";
            $message['content'] = $e->getMessage();
            return back()->with($message);
        }
    }
}
