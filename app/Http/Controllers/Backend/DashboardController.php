<?php

namespace HappyFeet\Http\Controllers\Backend;

use Illuminate\Http\Request;
use HappyFeet\Http\Controllers\Controller;
use HappyFeet\RepositoryInterface\FieldRepositoryInterface;
use HappyFeet\RepositoryInterface\StudentRepositoryInterface;
use HappyFeet\RepositoryInterface\SeasonRepositoryInterface;
use HappyFeet\Exceptions\AssistanceException;




class DashboardController extends Controller
{
    

	protected $field;
    protected $seasonRepo;
    protected $studentRepo;

    public function __construct(FieldRepositoryInterface $field, SeasonRepositoryInterface $seasonRepo, StudentRepositoryInterface $studentRepo)
    {
    	// $this->middleware('auth.backend')->except('logout');
    	$this->middleware('auth');
    	$this->field = $field;
        $this->seasonRepo = $seasonRepo;
        $this->studentRepo = $studentRepo;
    }

    public function showDash(Request $request)
    {
    	$totalStudents = $this->studentRepo->getTotalStudents();
        $currentSeason = $this->seasonRepo->getActive();
        $totalFields = $this->field->getNumActives();
        $fields = $this->field->enum();
        return view('backend.dashboard.index',compact('totalStudents','currentSeason','totalFields','fields'));
    }


    public function loadAssistance(Request $request)
    {
        try {
            
            $asistances = $this->assistance->getAssistanceByGroup($request->all());
            return response(compact($asistances),200);
        } catch (AssistanceException $e) {
            
        }
    }
}
