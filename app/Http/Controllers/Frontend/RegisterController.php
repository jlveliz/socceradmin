<?php

namespace HappyFeet\Http\Controllers\Frontend;

use HappyFeet\RepositoryInterface\RegisterStudentFrontendRepositoryInterface;
use HappyFeet\RepositoryInterface\RepresentantRepositoryInterface;
use HappyFeet\RepositoryInterface\AgeRangeRepositoryInterface;
use HappyFeet\RepositoryInterface\FieldRepositoryInterface;
use HappyFeet\Exceptions\AgeRangeException;
use HappyFeet\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Validator;


class RegisterController extends Controller
{
    
    private $representantRepository;
    private $registerRepo;
    private $ageRageRepo;
    private $fieldRepo;

    public function __construct(RepresentantRepositoryInterface $representantRepository,RegisterStudentFrontendRepositoryInterface  $registerRepo, AgeRangeRepositoryInterface $ageRageRepo, FieldRepositoryInterface $fieldRepo)
    {
        $this->representantRepository = $representantRepository;
        $this->registerRepo = $registerRepo;
        $this->ageRageRepo = $ageRageRepo;
        $this->fieldRepo = $fieldRepo;
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
}
