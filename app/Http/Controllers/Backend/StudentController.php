<?php

namespace HappyFeet\Http\Controllers\Backend;

use HappyFeet\Http\Controllers\Controller;
use HappyFeet\RepositoryInterface\StudentRepositoryInterface;
use HappyFeet\RepositoryInterface\SeasonRepositoryInterface;
use HappyFeet\RepositoryInterface\FieldRepositoryInterface;
use HappyFeet\Http\Requests\StudentRequest;
use HappyFeet\Exception\StudentException;
use HappyFeet\Exceptions\GroupClassException;
use HappyFeet\Exceptions\EnrollmentGroupException;
use Exception;
use DB;

class StudentController extends Controller
{
    
    protected $studentRepo;
    protected $seasonRepo;
    protected $fieldRepo;

    protected $routeRedirectIndex = 'students.index';

    function __construct(StudentRepositoryInterface $studentRepo, SeasonRepositoryInterface $seasonRepo, FieldRepositoryInterface $fieldRepo)
    {
        $this->middleware('auth');
        $this->studentRepo = $studentRepo;
        $this->seasonRepo = $seasonRepo;
        $this->fieldRepo = $fieldRepo;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = $this->studentRepo->enum();
        return view('backend.student.index',compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $seasons = $this->seasonRepo->enum(['state'=>$this->seasonRepo->getModel()->getActive()]);
        $fields = $this->fieldRepo->enum();
        return view('backend.student.create-edit',compact('seasons','fields'));
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
            'type' => 'success',
            'content' =>'',
        ];

        //begin transaction
		DB::beginTransaction();

        try {
            $message['content'] = "Se ha creado el estudiante satisfactoriamente";
            $student = $this->studentRepo->save($request->all());
            DB::commit();
            if ($request->get('redirect-index') == 1) {
                return redirect()->route($this->routeRedirectIndex)->with($message);
            } else {
                return redirect()->route('students.edit',['id'=>$student->id])->with($message);
            }
        } catch (StudentException $e) {
            DB::rollback();
            $message['type'] = "error";
            $message['content'] = $e->getMessage();
            return back()->with($message);
        } catch (GroupClassException $e) {
            DB::rollback();
            $message['type'] = "error";
            $message['content'] = $e->getMessage();
            return back()->with($message);
        } catch (EnrollmentGroupException $e) {
            DB::rollback();
            $message['type'] = "error";
            $message['content'] = $e->getMessage();
            return back()->with($message);
        } 
        // catch (Exception $e) {
        //     DB::rollback();
        //     $message['type'] = "error";
        //     $message['content'] = $e->getMessage();
        //     return back()->with($message);
        // }
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
        $seasons = $this->seasonRepo->enum(['state'=>$this->seasonRepo->getModel()->getActive()]);
        $fields = $this->fieldRepo->enum();
        
        return view('backend.student.create-edit',compact('student','seasons','fields'));
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
            'type' => 'success',
            'content' =>'',
        ];

        //begin transaction
        DB::beginTransaction();
        try {
          $student = $this->studentRepo->edit($id,$request->all());
          $message['content'] = "Se ha Actualizado el estudiante satisfactoriamente";
          DB::commit();
          if ($request->get('redirect-index') == 1) { 
            return redirect()->route($this->routeRedirectIndex)->with($message);
          } else {
            return back()->with($message);
          }
          
        } catch (StudentException $e) {
            DB::rollback();
            $message['type'] = "error";
            $message['content'] = $e->getMessage();
            return back()->with($message);
        } catch (GroupClassException $e) {
            DB::rollback();
            $message['type'] = "error";
            $message['content'] = $e->getMessage();
            return back()->with($message);
        } catch (EnrollmentGroupException $e) {
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
