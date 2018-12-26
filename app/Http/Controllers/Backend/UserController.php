<?php

namespace HappyFeet\Http\Controllers\Backend;

use HappyFeet\Http\Controllers\Controller;
use HappyFeet\RepositoryInterface\UserRepositoryInterface;
use HappyFeet\RepositoryInterface\RoleRepositoryInterface;
use HappyFeet\Exception\UserException;
use HappyFeet\Http\Requests\UserRequest;

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
        $users = $this->userRepo->paginate();
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
            'type' => 'primary',
            'content' =>'',
        ];

        try {
            $message['content'] = "Se ha creado el usuario satisfactoriamente";
            $user = $this->userRepo->save($request->all());
            if ($request->get('redirect-index') == 1) {
                return redirect()->route($this->routeRedirectIndex)->with($message);
            } else {
                return redirect()->route('users.edit',['id'=>$user->id])->with($message);
            }
        } catch (UserException $e) {
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
            'type' => 'primary',
            'content' =>'',
        ];
        try {
          $user = $this->userRepo->edit($id,$request->all());
          $message['content'] = "Se ha Actualizado el usuario satisfactoriamente";
          
          if ($request->get('redirect-index') == 1) { 
            return redirect()->route($this->routeRedirectIndex)->with($message);
          } else {
            return back()->with($message);
          }
          
        } catch (UserException $e) {
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
            $deleted = $this->userRepo->remove($id);
            $message['content'] = "Se ha eliminado el usuario satisfactoriamente";
            return back()->with($message);
        } catch (UserException $e) {
            $message['type'] = "error";
            $message['content'] = $e->getMessage();
            return back()->with($message);
        }
    }
}
