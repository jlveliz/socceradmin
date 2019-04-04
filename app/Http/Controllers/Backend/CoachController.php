<?php

namespace HappyFeet\Http\Controllers\Backend;

use HappyFeet\Http\Controllers\Controller;
use HappyFeet\RepositoryInterface\CoachRepositoryInterface;
use HappyFeet\Http\Requests\CoachRequest;
use HappyFeet\Exception\CoachException;

class CoachController extends Controller
{
    
    protected $coachRepo;
    protected $seasonRepo;
    protected $fieldRepo;

    protected $routeRedirectIndex = 'coachs.index';

    function __construct(CoachRepositoryInterface $coachRepo)
    {
        $this->middleware('auth');
        $this->coachRepo = $coachRepo;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coachs = $this->coachRepo->enum();
        return view('backend.coach.index',compact('coachs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        #
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CoachRequest $request)
    {
       #
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $message = [
            'type' => 'success',
            'content' =>'',
        ];

        try {
            
            $coach = $this->coachRepo->find($id);
            return view('backend.coach.show',compact('coach'));
            
        } catch (CoachException $e) {
            
            $message['type'] = "error";
            $message['content'] = $e->getMessage();
            return back()->with($message);

        } catch (Exception $e) {
            
            $message['type'] = "error";
            $message['content'] = $e->getMessage();
            return back()->with($message);
            
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        #
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CoachRequest $request, $id)
    {
        #
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        #
    }


    public function getAssistances()
    {
        
    }
}
