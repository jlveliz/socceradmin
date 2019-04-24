<?php

namespace HappyFeet\Http\Controllers\Frontend;

use HappyFeet\RepositoryInterface\RegisterStudentFrontendRepositoryInterface;
use HappyFeet\RepositoryInterface\RepresentantRepositoryInterface;
use HappyFeet\RepositoryInterface\AgeRangeRepositoryInterface;
use HappyFeet\RepositoryInterface\StudentRepositoryInterface;
use HappyFeet\RepositoryInterface\FieldRepositoryInterface;
use HappyFeet\Exceptions\AgeRangeException;
use HappyFeet\Http\Controllers\Controller;
use HappyFeet\Http\Requests\UserFrontendRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Validator;
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
            $user = $this->studentRepo->save($request->all());
            DB::commit();
          
        } catch (UserException $e) {
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
}
