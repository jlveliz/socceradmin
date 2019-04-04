<?php

namespace HappyFeet\Http\Controllers\Backend;

use HappyFeet\Http\Controllers\Controller;
use HappyFeet\RepositoryInterface\RoleRepositoryInterface;
use HappyFeet\RepositoryInterface\ModuleRepositoryInterface;
use HappyFeet\RepositoryInterface\PermissionTypeRepositoryInterface;
use HappyFeet\Http\Requests\RoleRequest;
use HappyFeet\Exceptions\RoleException;
use Exception;
use DB;
class RoleController extends Controller
{
    
    protected $role;

    protected $module;

    protected $perTypes;

    protected $routeRedirectIndex = 'roles.index';


    function __construct(RoleRepositoryInterface $role, ModuleRepositoryInterface $module, PermissionTypeRepositoryInterface $perTypes)
    {
       $this->middleware('auth');
        $this->role = $role;
        $this->module = $module;
        $this->perTypes = $perTypes;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->role->enum();
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

        $paramPermissionType = [
            'state' => $this->perTypes->getModel()->getActive()
        ];

        $modules = $this->module->enum($paramModule);
        $permissionTypes = $this->perTypes->enum($paramPermissionType);
        return view('backend.role.create-edit',compact('modules','permissionTypes'));
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
         DB::beginTransaction();
        try {
            $message['content'] = "Se ha creado el rol satisfactoriamente";
            $role = $this->role->save($request->all());
             DB::commit();
            if ($request->get('redirect-index') == 1) {
                return redirect()->route($this->routeRedirectIndex)->with($message);
            } else {
                return redirect()->route('roles.edit',['id'=>$role->id])->with($message);
            }
        } catch (RoleException $e) {
             DB::rollback();
            $message['type'] = "error";
            $message['content'] = $e->getMessage();
            return back()->with($message);
        }catch (Exception $e) {
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
        $paramModule = [
            'state' => $this->module->getModel()->getActive()
        ];
        $paramPermissionType = [
            'state' => $this->perTypes->getModel()->getActive()
        ];
        
        $modules = $this->module->enum($paramModule);
        
        $permissionTypes = $this->perTypes->enum($paramPermissionType);
        return view('backend.role.create-edit',compact('role','modules','permissionTypes'));
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
    public function destroy($id, RoleRequest $request)
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
