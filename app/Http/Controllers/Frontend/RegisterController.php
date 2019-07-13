<?php

namespace Futbol\Http\Controllers\Frontend;

use Futbol\RepositoryInterface\RegisterStudentFrontendRepositoryInterface;
use Futbol\RepositoryInterface\RepresentantRepositoryInterface;
use Futbol\RepositoryInterface\AgeRangeRepositoryInterface;
use Futbol\RepositoryInterface\StudentRepositoryInterface;
use Futbol\RepositoryInterface\FieldRepositoryInterface;
use Futbol\Exceptions\AgeRangeException;
use Futbol\Exceptions\StudentException;
use Futbol\Events\NewDemoClass;
use Futbol\Http\Controllers\Controller;
use Futbol\Http\Requests\UserFrontendRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Validator;
use Exception;
use DB;


class RegisterController extends Controller
{
    
    private $representantRepository;
    private $registerRepo;
    private $ageRageRepo;
    private $fieldRepo;
    private $studentRepo;

    public function __construct(RepresentantRepositoryInterface $representantRepository,RegisterStudentFrontendRepositoryInterface  $registerRepo, AgeRangeRepositoryInterface $ageRageRepo, FieldRepositoryInterface $fieldRepo, StudentRepositoryInterface $studentRepo)
    {
        $this->representantRepository = $representantRepository;
        $this->registerRepo = $registerRepo;
        $this->ageRageRepo = $ageRageRepo;
        $this->fieldRepo = $fieldRepo;
        $this->studentRepo = $studentRepo;
    }

    public function showRegisterForm()
    {
        try { 
            $ages = $this->ageRageRepo->getRangeSecuence();
            $fields = $this->fieldRepo->enum();
            return view('frontend.auth.register',compact('ages','fields'));
        } catch (AgeRangeException $e) {
            $message['type'] = "error";
            $message['content'] = $e->getMessage();
            return back()->with($message);
        }
    }


    public function process(UserFrontendRequest $request)
    {
        $message = [
            'type' => 'success',
            'content' =>'',
        ];
        
        DB::beginTransaction();
        
        try {
            $message['content'] = "Se ha creado el usuario satisfactoriamente";
            $user = $this->studentRepo->insertFromRegisterForm($request->all());
            DB::commit();
            event( new NewDemoClass($user) );
            return response(["https://sur.happyfeetsoccer.com.ec/gracias/"],200);
        } catch (StudentException $e) {
            DB::rollback();
            $message['type'] = "error";
            $message['content'] = $e->getMessage();
            return response($message,$e->getCode());
        } 
        catch (Exception $e) {
            DB::rollback();
            $message['type'] = "error";
            $message['content'] = $e->getMessage();
            return response($message,$e->getCode());
        }
    }
}
