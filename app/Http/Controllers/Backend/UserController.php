<?php

namespace Futbol\Http\Controllers\Backend;

use Futbol\Http\Controllers\Controller;
use Futbol\RepositoryInterface\UserRepositoryInterface;
use Futbol\RepositoryInterface\RoleRepositoryInterface;
use Futbol\Exception\UserException;
use Futbol\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Exception;
use DB;


class UserController extends Controller
{
    
    protected $userRepo;

    protected $roleRepo;

    protected $routeRedirectIndex = 'users.index';

    function __construct(UserRepositoryInterface $userRepo, RoleRepositoryInterface  $roleRepo)
    {
        $this->middleware('auth');
        $this->userRepo = $userRepo;
        $this->roleRepo = $roleRepo;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userRepo->enum();
        return view('backend.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->roleRepo->enum();
        return view('backend.user.create-edit',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $message = [
            'type' => 'success',
            'content' =>'',
        ];
        DB::beginTransaction();
        try {
            $message['content'] = "Se ha creado el usuario satisfactoriamente";
            $user = $this->userRepo->save($request->all());
            DB::commit();
            if ($request->get('redirect-index') == 1) {
                return redirect()->route($this->routeRedirectIndex)->with($message);
            } else {
                return redirect()->route('users.edit',['id'=>$user->id])->with($message);
            }
        } catch (UserException $e) {
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
        $user = $this->userRepo->find($id);
        $roles = $this->roleRepo->enum();
        return view('backend.user.create-edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $message = [
            'type' => 'success',
            'content' =>'',
        ];
         DB::beginTransaction();
        try {
            $user = $this->userRepo->edit($id,$request->all());
            DB::commit();
            $message['content'] = "Se ha Actualizado el usuario satisfactoriamente";
          
              if ($request->get('redirect-index') == 1) { 
                return redirect()->route($this->routeRedirectIndex)->with($message);
              } else {
                return back()->with($message);
              }
          
        } catch (UserException $e) {
            DB::rollback();
            $message['type'] = 'error';
            $message['content'] = $e->getMessage();
        }catch (Exception $e) {
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
            $deleted = $this->userRepo->remove($id);
            DB::commit();
            $message['content'] = "Se ha eliminado el usuario satisfactoriamente";
            return back()->with($message);
        } catch (UserException $e) {
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
     * Search a user with role 'Representant'.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchRepresentant(Request $request) {
        
        if($request->has('query')) {       
            $users = $this->userRepo->getRepresentant($request->get('query'));
            return response($users,200);
        } else {
            return response('Parametros mal enviados',401);
        }

    }



}
