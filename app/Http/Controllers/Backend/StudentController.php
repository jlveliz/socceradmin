<?php

namespace HappyFeet\Http\Controllers\Backend;

use HappyFeet\Http\Controllers\Controller;
use HappyFeet\RepositoryInterface\StudentRepositoryInterface;
use HappyFeet\Exception\StudentException;
use HappyFeet\Http\Requests\StudentRequest;

class StudentController extends Controller
{
    
    protected $studentRepo;

    protected $routeRedirectIndex = 'students.index';

    function __construct(StudentRepositoryInterface $studentRepo)
    {
        $this->middleware('auth');
        $this->studentRepo = $studentRepo;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = $this->studentRepo->paginate();
        return view('backend.student.index',compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.student.create-edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        $message = [
            'type' => 'primary',
            'content' =>'',
        ];

        try {
            $message['content'] = "Se ha creado el estudiante satisfactoriamente";
            $student = $this->studentRepo->save($request->all());
            if ($request->get('redirect-index') == 1) {
                return redirect()->route($this->routeRedirectIndex)->with($message);
            } else {
                return redirect()->route('students.edit',['id'=>$student->id])->with($message);
            }
        } catch (StudentException $e) {
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
        $student = $this->studentRepo->find($id);
        return view('backend.student.create-edit',compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequest $request, $id)
    {
        $message = [
            'type' => 'primary',
            'content' =>'',
        ];
        try {
          $student = $this->studentRepo->edit($id,$request->all());
          $message['content'] = "Se ha Actualizado el estudiante satisfactoriamente";
          
          if ($request->get('redirect-index') == 1) { 
            return redirect()->route($this->routeRedirectIndex)->with($message);
          } else {
            return back()->with($message);
          }
          
        } catch (StudentException $e) {
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
            $deleted = $this->studentRepo->remove($id);
            $message['content'] = "Se ha eliminado el estudiante satisfactoriamente";
            return back()->with($message);
        } catch (StudentException $e) {
            $message['type'] = "error";
            $message['content'] = $e->getMessage();
            return back()->with($message);
        }
    }
}
