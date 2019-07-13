<?php

namespace Futbol\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Futbol\Http\Controllers\Controller;
use Futbol\Http\Requests\AgeRangeRequest;
use Futbol\RepositoryInterface\AgeRangeRepositoryInterface;
use Futbol\Exceptions\AgeRangeException;


class AgeRangeController extends Controller
{
    

    protected $ageRange;

    protected $routeRedirectIndex = 'ageranges.index';


    public function __construct(AgeRangeRepositoryInterface $ageRange)
    {
        $this->middleware('auth');
        $this->ageRange = $ageRange;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $ageRanges = $this->ageRange->enum();
        return view('backend.agerange.index',compact('ageRanges'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.agerange.create-edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AgeRangeRequest $request)
    {
        $message = [
            'type' => 'success',
            'content' =>'',
        ];

        try {
            $message['content'] = "Se ha creado el rango de edad satisfactoriamente";
            $ageRange = $this->ageRange->save($request->all());
            if ($request->get('redirect-index') == 1) {
                return redirect()->route($this->routeRedirectIndex)->with($message);
            } else {
                return redirect()->route('ageranges.edit',['id'=>$ageRange->id])->with($message);
            }
        } catch (AgeRangeException $e) {
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
        $agerange = $this->ageRange->find($id);
        return view('backend.agerange.create-edit',compact('agerange'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $message = [
            'type' => 'success',
            'content' =>'',
        ];
        try {
          $ageRange = $this->ageRange->edit($id,$request->all());
          $message['content'] = "Se ha Actualizado el rango de edad satisfactoriamente";
          
          if ($request->get('redirect-index') == 1) { 
            return redirect()->route($this->routeRedirectIndex)->with($message);
          } else {
            return back()->with($message);
          }
          
        } catch (AgeRangeException $e) {
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
            'type' => 'success',
            'content' =>'',
        ];
        try {
            $deleted = $this->ageRange->remove($id);
            $message['content'] = "Se ha eliminado el rango de edad satisfactoriamente";
            return back()->with($message);
        } catch (AgeRangeException $e) {
            $message['type'] = "error";
            $message['content'] = $e->getMessage();
            return back()->with($message);
        }
        
    }
}
