<?php

namespace Futbol\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Futbol\Http\Controllers\Controller;
use Futbol\RepositoryInterface\PermissionTypeRepositoryInterface;
use Futbol\Http\Requests\PermissionTypeRequest;
use Futbol\Exceptions\PermissionTypeException;
use Exception;
use DB;

class PermissionTypeController extends Controller
{
    
    protected $permissionType;

    protected $routeRedirectIndex = 'permission-types.index';


    function __construct(PermissionTypeRepositoryInterface $permissionType)
    {
        $this->middleware('auth');
        $this->permissionType = $permissionType;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissionTypes = $this->permissionType->enum();
        return view('backend.permission-type.index',compact('permissionTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.permission-type.create-edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionTypeRequest $request)
    {
        $message = [
            'type' => 'success',
            'content' =>'',
        ];
        //begin transaction
        DB::beginTransaction();

        try {
            $message['content'] = "Se ha creado el tipo de permiso satisfactoriamente";
            $permissionType = $this->permissionType->save($request->all());
            DB::commit();
            if ($request->get('redirect-index') == 1) {
                return redirect()->route($this->routeRedirectIndex)->with($message);
            } else {
                return redirect()->route('permission-types.edit',['id'=>$permissionType->id])->with($message);
            }
        } catch (PermissionTypeException $e) {
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
        $permissionType = $this->permissionType->find($id);
        return view('backend.permission-type.create-edit',compact('permissionType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionTypeRequest $request, $id)
    {
        $message = [
            'type' => 'success',
            'content' =>'',
        ];
         //begin transaction
        DB::beginTransaction();
        try {
          $permissionType = $this->permissionType->edit($id,$request->all());
          $message['content'] = "Se ha Actualizado el tipo de permiso satisfactoriamente";
          DB::commit();
          if ($request->get('redirect-index') == 1) { 
            return redirect()->route($this->routeRedirectIndex)->with($message);
          } else {
            return back()->with($message);
          }
          
        } catch (PermissionTypeException $e) {
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
    public function destroy(PermissionTypeRequest $request, $id)
    {
        $message = [
            'type' => 'success',
            'content' =>'',
        ]; 
        
        DB::beginTransaction();
 
        try {
            $deleted = $this->permissionType->remove($id);
            DB::commit();
            $message['content'] = "Se ha eliminado el tipo de permiso satisfactoriamente";
            return back()->with($message);
        } catch (PermissionTypeException $e) {
            $message['type'] = "error";
            DB::rollback();
            $message['content'] = $e->getMessage();
            return back()->with($message);
        }catch (Exception $e) {
            DB::rollback();
            $message['type'] = "error";
            $message['content'] = $e->getMessage();
            return back()->with($message);
        }
    }
}
