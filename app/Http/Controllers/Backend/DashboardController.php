<?php

namespace HappyFeet\Http\Controllers\Backend;

use Illuminate\Http\Request;
use HappyFeet\Http\Controllers\Controller;
use HappyFeet\RepositoryInterface\AssistanceRepositoryInterface;
use HappyFeet\RepositoryInterface\FieldRepositoryInterface;
use HappyFeet\RepositoryInterface\GroupClassRepositoryInterface;
use HappyFeet\RepositoryInterface\SeasonRepositoryInterface;
use HappyFeet\Http\Requests\AssistanceRequest;
use HappyFeet\Exceptions\AssistanceException;




class DashboardController extends Controller
{
    

	protected $assistance;
    protected $field;
    protected $grClass;
    protected $seasonRepo;

    public function __construct(AssistanceRepositoryInterface $assistance, FieldRepositoryInterface $field, GroupClassRepositoryInterface $grClass, SeasonRepositoryInterface $seasonRepo)
    {
    	// $this->middleware('auth.backend')->except('logout');
    	$this->middleware('auth');
    	$this->assistance = $assistance;
        $this->field = $field;
        $this->grClass = $grClass;
        $this->seasonRepo = $seasonRepo;
    }

    public function showDash(Request $request)
    {
    	$fields = $this->field->enum();
        $currentSeason = $this->seasonRepo->getActive();
        
    	if ($request->has('field')) {
    	    $days = $this->field->find($request->get('field'))->available_days;
    	} else {
    	    $days = [];
    	}

    	if ($request->has('key_day')) {
    	    $groups = $this->grClass->findByFieldAndDay($request->get('field'),$request->get('key_day'));
    	} else {
    	    $groups = [];
    	}

    	if ($request->has('group_id')) {
    	    $months = $this->seasonRepo->getMonthForSeason($currentSeason->id);
    	} else {
    	    $months = [];
    	}

    	if ($request->has('field') && $request->has('key_day') && $request->has('group_id') && $request->has('month')) {
    	    $assistances = $this->assistance->getAssistanceByGroup($request->all());
    	} else {
    	    $assistances = [];
    	}

    	return view('backend.dashboard.index',compact('assistances','fields','days','groups','currentSeason','months'));
    }
}
