<?php

namespace HappyFeet\Http\Controllers\Backend;

use HappyFeet\Http\Controllers\Controller;
use HappyFeet\RepositoryInterface\PersonTypeRepositoryInterface;
use HappyFeet\Exceptions\PersonTypeException;
use HappyFeet\Http\Requests\PersonTypeRequest;

class PersonTypeController extends Controller
{
    
    protected $personType;

    protected $routeRedirectIndex = 'ptypes.index';

    function __construct(PersonTypeRepositoryInterface $personType)
    {
        $this->personType = $personType;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personTypes = $this->personType->enum();
        return view('backend.ptype.index',compact('personTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.ptype.create-edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonTypeRequest $request)
    {
        $message = [
            'type' => 'primary',
            'content' =>'',
        ];

        try {
            $message['content'] = "Se ha creado el Tipo de persona satisfactoriamente";
            $ptype = $this->personType->save($request->all());
            if ($request->get('redirect-index') == 1) {
                return redirect()->route($this->routeRedirectIndex)->with($message);
            } else {
                return redirect()->route('ptypes.edit',['id'=>$ptype->id])->with($message);
            }
        } catch (PersonTypeException $e) {
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
        $ptype = $this->personType->find($id);
        return view('backend.ptype.create-edit',compact('ptype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PersonTypeRequest $request, $id)
    {
       $message = [
            'type' => 'primary',
            'content' =>'',
        ];
        
        try {
          $ptype = $this->personType->edit($id,$request->all());
          $message['content'] = "Se ha Actualizado el tipo de persona satisfactoriamente";
          
          if ($request->get('redirect-index') == 1) { 
            return redirect()->route($this->routeRedirectIndex)->with($message);
          } else {
            return back()->with($message);
          }
          
        } catch (PersonTypeException $e) {
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
    public function destroy(PersonTypeRequest $request,$id)
    {
        $message = [
            'type' => 'primary',
            'content' =>'',
        ];
        
        try {
            $deleted = $this->personType->remove($id);

            $message['content'] = "Se ha eliminado el tipo de persona satisfactoriamente";
            return back()->with($message);
        } catch (PersonTypeException $e) {
            $message['type'] = "error";
            $message['content'] = $e->getMessage();
            return back()->with($message);
        }
    }
}
