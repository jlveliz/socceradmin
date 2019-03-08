<?php

namespace HappyFeet\Http\Controllers\Backend;

use Illuminate\Http\Request;
use HappyFeet\Http\Controllers\Controller;
use HappyFeet\RepositoryInterface\SeasonRepositoryInterface;
use HappyFeet\Http\Requests\SeasonRequest;
use HappyFeet\Exceptions\SeasonException;
use Exception;
use DB;

class SeasonController extends Controller
{
    
    protected $season;

    protected $routeRedirectIndex = 'seasons.index';


    function __construct(SeasonRepositoryInterface $season)
    {
        $this->middleware('auth');
        $this->season = $season;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seasons = $this->season->enum();
        return view('backend.season.index',compact('seasons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $timeStrings = get_durations_string();
        return view('backend.season.create-edit',compact('timeStrings'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SeasonRequest $request)
    {
        $message = [
            'type' => 'primary',
            'content' =>'',
        ];
          //begin transaction
        DB::beginTransaction();

        try {
            $message['content'] = "Se ha creado la temporada Satisfactoriamente";
            $season = $this->season->save($request->all());
            DB::commit();
            if ($request->get('redirect-index') == 1) {
                return redirect()->route($this->routeRedirectIndex)->with($message);
            } else {
                return redirect()->route('seasons.edit',['id'=>$season->id])->with($message);
            }
        } catch (SeasonException $e) {
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
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
        $timeStrings = get_durations_string();
        $season = $this->season->find($id);
        return view('backend.season.create-edit',compact('season','timeStrings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SeasonRequest $request, $id)
    {
        $message = [
            'type' => 'primary',
            'content' =>'',
        ];
          //begin transaction
        DB::beginTransaction();

        try {

            $season = $this->season->edit($id,$request->all());
            DB::commit();
            $message['content'] = "Se ha Actualizado la temporada satisfactoriamente";
            
          if ($request->get('redirect-index') == 1) { 
            return redirect()->route($this->routeRedirectIndex)->with($message);
          } else {
            return back()->with($message);
          }
          
        } catch (SeasonException $e) {
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
    public function destroy($id, SeasonRequest $request)
    {
        $message = [
            'type' => 'primary',
            'content' =>'',
        ];
          //begin transaction
        DB::beginTransaction();
        try {
            $deleted = $this->season->remove($id);
            DB::commit();
            $message['content'] = "Se ha eliminado la temporada satisfactoriamente";
            return back()->with($message);
        } catch (SeasonException $e) {
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
