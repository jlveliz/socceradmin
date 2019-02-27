<?php

namespace HappyFeet\Http\Controllers\Backend;

use Illuminate\Http\Request;
use HappyFeet\Http\Controllers\Controller;
use HappyFeet\Http\Requests\FieldTypeRequest;
use HappyFeet\RepositoryInterface\FieldTypeRepositoryInterface;
use HappyFeet\Exceptions\FieldTypeException;


class FieldTypeController extends Controller
{
    

    protected $fieldType;

    protected $routeRedirectIndex = 'ftypes.index';


    public function __construct(FieldTypeRepositoryInterface $fieldType)
    {
        $this->middleware('auth');
        $this->fieldType = $fieldType;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $fieldTypes = $this->fieldType->enum();
        return view('backend.ftype.index',compact('fieldTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.ftype.create-edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FieldTypeRequest $request)
    {
        $message = [
            'type' => 'primary',
            'content' =>'',
        ];

        try {
            $message['content'] = "Se ha creado el tipo de cancha satisfactoriamente";
            $fieldType = $this->fieldType->save($request->all());
            if ($request->get('redirect-index') == 1) {
                return redirect()->route($this->routeRedirectIndex)->with($message);
            } else {
                return redirect()->route('ftypes.edit',['id'=>$fieldType->id])->with($message);
            }
        } catch (FieldTypeException $e) {
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
        $ftype = $this->fieldType->find($id);
        return view('backend.ftype.create-edit',compact('ftype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $message = [
            'type' => 'primary',
            'content' =>'',
        ];
        try {
          $fieldType = $this->fieldType->edit($id,$request->all());
          $message['content'] = "Se ha Actualizado el tipo de cancha satisfactoriamente";
          
          if ($request->get('redirect-index') == 1) { 
            return redirect()->route($this->routeRedirectIndex)->with($message);
          } else {
            return back()->with($message);
          }
          
        } catch (FieldTypeException $e) {
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
    public function destroy(FieldTypeRequest $request,$id)
    {
        $message = [
            'type' => 'primary',
            'content' =>'',
        ];
        try {
            $deleted = $this->fieldType->remove($id);
            $message['content'] = "Se ha eliminado el tipo de cancha satisfactoriamente";
            return back()->with($message);
        } catch (FieldTypeException $e) {
            $message['type'] = "error";
            $message['content'] = $e->getMessage();
            return back()->with($message);
        }
        
    }
}
