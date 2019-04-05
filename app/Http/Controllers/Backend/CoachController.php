<?php

namespace HappyFeet\Http\Controllers\Backend;

use HappyFeet\Http\Controllers\Controller;
use HappyFeet\RepositoryInterface\CoachRepositoryInterface;
use HappyFeet\Http\Requests\CoachRequest;
use HappyFeet\Exception\CoachException;
use DB;

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
        return view('backend.coach.create-edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CoachRequest $request)
    {
       $message = [
            'type' => 'success',
            'content' =>'',
        ];
        
        DB::beginTransaction();
        try {
            $message['content'] = "Se ha creado el coach satisfactoriamente";
            $coach = $this->coachRepo->save($request->all());
            DB::commit();
            if ($request->get('redirect-index') == 1) {
                return redirect()->route($this->routeRedirectIndex)->with($message);
            } else {
                return redirect()->route('coachs.edit',['id'=>$coach->id])->with($message);
            }
        } catch (CoachException $e) {
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coach = $this->coachRepo->find($id);
        return view('backend.coach.create-edit',compact('coach'));
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
        $message = [
            'type' => 'success',
            'content' =>'',
        ];
        DB::beginTransaction();
        
        try {
            $coach = $this->coachRepo->edit($id,$request->all());
            DB::commit();
            $message['content'] = "Se ha Actualizado el coach satisfactoriamente";
          
              if ($request->get('redirect-index') == 1) { 
                return redirect()->route($this->routeRedirectIndex)->with($message);
              } else {
                return back()->with($message);
              }
          
        } catch (CoachException $e) {
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
            $deleted = $this->coachRepo->remove($id);
            DB::commit();
            $message['content'] = "Se ha eliminado el coach satisfactoriamente";
            return back()->with($message);
        } catch (CoachException $e) {
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
}
