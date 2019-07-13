<?php

namespace Futbol\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Futbol\Http\Controllers\Controller;
use Futbol\RepositoryInterface\FieldRepositoryInterface;
use Futbol\RepositoryInterface\StudentRepositoryInterface;
use Futbol\RepositoryInterface\SeasonRepositoryInterface;
use Futbol\RepositoryInterface\AssistanceRepositoryInterface;
use Futbol\Exceptions\AssistanceException;




class DashboardController extends Controller
{
    

	protected $field;
    protected $seasonRepo;
    protected $studentRepo;
    protected $assistance;

    public function __construct(FieldRepositoryInterface $field, SeasonRepositoryInterface $seasonRepo, StudentRepositoryInterface $studentRepo, AssistanceRepositoryInterface $assistance)
    {
    	// $this->middleware('auth.backend')->except('logout');
    	$this->middleware('auth');
    	$this->field = $field;
        $this->seasonRepo = $seasonRepo;
        $this->studentRepo = $studentRepo;
        $this->assistance = $assistance;
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
            return response($asistances,200);
        } catch (AssistanceException $e) {
            
        }
    }
}
