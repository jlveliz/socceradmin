<?php

namespace HappyFeet\Http\Controllers\Backend;

use Illuminate\Http\Request;
use HappyFeet\Http\Controllers\Controller;
use HappyFeet\RepositoryInterface\GroupClassRepositoryInterface;
use HappyFeet\RepositoryInterface\FieldRepositoryInterface;
use HappyFeet\RepositoryInterface\AgeRangeRepositoryInterface;
use HappyFeet\Http\Requests\GroupClassRequest;
use HappyFeet\Exceptions\GroupClassException;

class GroupClassController extends Controller
{
    
    protected $groupClass;
    protected $field;
    protected $ageRange;

    protected $routeRedirectIndex = 'groupclass.index';


    function __construct(GroupClassRepositoryInterface $groupClass, FieldRepositoryInterface $field, AgeRangeRepositoryInterface $ageRange)
    {
        $this->middleware('auth');
        $this->groupClass = $groupClass;
        $this->field = $field;
        $this->ageRange = $ageRange;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = $this->groupClass->paginate();
        return view('backend.groupclass.index',compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fields = $this->field->enum();
        $aRanges = $this->ageRange->enum();
        return view('backend.groupclass.create-edit',compact('fields','aRanges'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GroupClassRequest $request)
    {
        $message = [
            'type' => 'primary',
            'content' =>'',
        ];

        try {
            $message['content'] = "Se ha creado el Grupo Satisfactoriamente";
            $groupClass = $this->groupClass->save($request->all());
            if ($request->get('redirect-index') == 1) {
                return redirect()->route($this->routeRedirectIndex)->with($message);
            } else {
                return redirect()->route('groupclass.edit',['id'=>$groupClass->id])->with($message);
            }
        } catch (GroupClassException $e) {
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
        
        $groupClass = $this->groupClass->find($id);
        return view('backend.groupClass.create-edit',compact('groupClass'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GroupClassRequest $request, $id)
    {
        $message = [
            'type' => 'primary',
            'content' =>'',
        ];
        try {
          $groupClass = $this->groupClass->edit($id,$request->all());
          $message['content'] = "Se ha Actualizado el grupo satisfactoriamente";
          
          if ($request->get('redirect-index') == 1) { 
            return redirect()->route($this->routeRedirectIndex)->with($message);
          } else {
            return back()->with($message);
          }
          
        } catch (GroupClassException $e) {
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
    public function destroy($id, Request $request)
    {
        $message = [
            'type' => 'primary',
            'content' =>'',
        ];
        try {
            $deleted = $this->groupClass->remove($id);
            $message['content'] = "Se ha eliminado el grupo satisfactoriamente";

            if($request->ajax()) {
                return response($message,200);
            } else {
                return back()->with($message);
            }

            
        } catch (GroupClassException $e) {
            $message['type'] = "error";
            $message['content'] = $e->getMessage();
            return back()->with($message);
        }
    }
}
