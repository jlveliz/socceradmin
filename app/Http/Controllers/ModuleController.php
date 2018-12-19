<?php

namespace HappyFeet\Http\Controllers;

use HappyFeet\RepositoryInterface\ModuleRepositoryInterface;
use HappyFeet\Http\Requests\ModuleRequest;
use HappyFeet\Exceptions\ModuleException;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    
    protected $moduleRepo; 

    public function __construct(ModuleRepositoryInterface $moduleRepo)
    {
        $this->middleware('auth');
        $this->moduleRepo = $moduleRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modules = $this->moduleRepo->enum();
        return view('module.index',compact('modules'));
    }


    public function create()
    {
        return view('module.create-edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ModuleRequest $request)
    {
        try {
            $data = $request->all();
            $module = $this->moduleRepo->save($data);


             if ($request->get('redirect') == 1) {
                return redirect()->route('modules.index')->with('mensaje','Módulo '.$module->name .' Creado Correctamente');
            } else {
                return redirect()->route('modules.edit',$module->id)->with('mensaje','Módulo '.$module->name .' Creado Correctamente');
            }

            

        } catch (ModuleException $e) {
            return back()->with($e->getMessage(),$e->getCode());
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
        
       #
    }


    public function edit($id)
    {
        try {

            $module = $this->moduleRepo->find($id);

            return view('module.create-edit',compact('module'));
            
        } catch (ModuleException $e) {
            return back()->with(['message' => 'no existe el recurso']);
        }
    }

   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ModuleRequest $request, $id)
    {
        try {
            $module = $this->moduleRepo->edit($id, $request->all());
           
            if ($request->get('redirect') == 1) {
                return redirect()->route('modules.index')->with('mensaje','Módulo '.$module->name .' Actualizado Correctamente');
            } else {
                return redirect()->route('modules.edit',$module->id)->with('mensaje','Módulo '.$module->name .' Actualizado Correctamente');
            }

        } catch (ModuleException $e) {
            return response()->json($e->getMessage(),$e->getCode());
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
        try {
            $removed = $this->moduleRepo->remove($id);
            
            if ($removed) {
                return redirect()->route('modules.index')->with('mensaje' , 'Se ha Eliminado  Satisfactoriamente el módulo');
            }
        } catch (ModuleException $e) {

            return back()->with($e->getMessage(),$e->getCode());
        }
    }
}
