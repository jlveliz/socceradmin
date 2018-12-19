<?php

namespace HappyFeet\Http\Controllers\Backend;

use HappyFeet\Http\Controllers\Controller;
use HappyFeet\RepositoryInterface\RoleRepositoryInterface;
use HappyFeet\RepositoryInterface\ModuleRepositoryInterface;
use HappyFeet\Http\Requests\RoleRequest;
use HappyFeet\Exceptions\RoleException;

class RoleController extends Controller
{
    
    protected $role;

    protected $module;

    protected $routeRedirectIndex = 'roles.index';


    function __construct(RoleRepositoryInterface $role, ModuleRepositoryInterface $module)
    {
       $this->middleware('auth.backend');
        $this->role = $role;
        $this->module = $module;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->role->paginate();
        return view('backend.role.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paramModule = [
            'state' => $this->module->getModel()->getActive()
        ];
        $modules = $this->module->enum($paramModule);
        return view('backend.role.create-edit',compact('modules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $message = [
            'type' => 'success',
            'content' =>'',
        ];

        try {
            $message['content'] = "Se ha creado el rol satisfactoriamente";
            $role = $this->role->save($request->all());
            if ($request->get('redirect-index') == 1) {
                return redirect()->route($this->routeRedirectIndex)->with($message);
            } else {
                return redirect()->route('roles.edit',['id'=>$role->id])->with($message);
            }
        } catch (RoleException $e) {
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
        $role = $this->role->find($id);
        return view('backend.role.create-edit',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        $message = [
            'type' => 'success',
            'content' =>'',
        ];
        try {
          $role = $this->role->edit($id,$request->all());
          $message['content'] = "Se ha Actualizado el rol satisfactoriamente";
          
          if ($request->get('redirect-index') == 1) { 
            return redirect()->route($this->routeRedirectIndex)->with($message);
          } else {
            return back()->with($message);
          }
          
        } catch (RoleException $e) {
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
            $deleted = $this->role->remove($id);
            $message['content'] = "Se ha eliminado el rol satisfactoriamente";
            return back()->with($message);
        } catch (RoleException $e) {
            $message['type'] = "error";
            $message['content'] = $e->getMessage();
            return back()->with($message);
        }
    }
}
