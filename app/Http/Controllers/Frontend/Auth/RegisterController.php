<?php

namespace HappyFeet\Http\Controllers\Frontend\Auth;

use Illuminate\Http\Request;
use HappyFeet\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use HappyFeet\RepositoryInterface\RepresentantRepositoryInterface;
use Validator;


class RegisterController extends Controller
{
    
    private $representantRepository;

    public function __construct(RepresentantRepositoryInterface $representantRepository)
    {
        $this->representantRepository = $representantRepository;
    }

    public function showRegisterForm()
    {
    	return view('frontend.auth.insert-identification');
    }

    public function verifyForm(Request $request)
    {
    	
    	$validator = Validator::make($request->all(), 
    		['num_identification' => 'required|valid_dni'],
    		[
    			'num_identification.valid_dni' => 'Ingrese una cédula válida',
    			'num_identification.required' => 'Ingrese una cédula válida'
    		]
    	);

    	if ($validator->fails()) 
    	{
    	 	return redirect()->back()
    	 	->withInput($request->only('num_identification'))
    	 	->withErrors(['num_identification'=> $validator->errors()->first()]);
    	}

    	
    	// si existe representante
    	// $existRepresentant = $this->existRepresentant($request);
        $representant = $this->representantRepository->find(['num_identification'=>$request->get('num_identification')]);

        //si no existe representante 
        if (!$representant) 
        {
            session()->put('representant.num_identification',$request->get('num_identification'));
            // hora de registrar padre
            return redirect()->route('register-wizard');
        } 


        //existe representante y busca si tiene niños
        if (count($representant->students) > 0) 
        { 
            foreach ($representant->students as $key => $student) 
            {
                //verifica si ha llevado a niño a clase demostrativa
                if ($student->hasTakenTrialClass()) { // lo ha llevado
                    dd("LLEVAR A PAGO");
                } else {
                    dd("tiene clase trial activa, reagendar y enviar a pago");
                }
            }
    	} 
        else 
        {
            //no tiene niños
            dd("esta registrado pero no tiene niños, hora de ingresar");
        }
    	
    }

    public function wizard(Request $request)
    {
        if (session()->has('representant.num_identification')) {
            
            return view('frontend.auth.register');

        } else {

            return redirect()->route('register-insert-identification');

        }
    }

    public function processWizard(Request $request)
    {

        
        if ($request->has('is_representant_name')) {

            $validator = Validator::make($request->all(),[
                'representant_name' => 'required|string',
                'representant_last_name' => 'required|string',
            ]);
            
            if ($validator->fails()) 
            {
                return redirect()->back()
                ->withInput($request->all())
                ->withErrors(
                    [
                        'representant_name' => $validator->errors()->first('representant_name'),
                        'representant_last_name' => $validator->errors()->first('representant_last_name')
                    ]
                );
            }

            session()->put('representant.name',$request->get('representant_name'));
            session()->put('representant.last_name',$request->get('representant_last_name'));
            session()->put('register_wizard.representant_exist_name',1);
        }
        

        //ingresa numero de telefono
        if ($request->has('is_representant_phone')) {
            
            $validator = Validator::make($request->all(),[
                'representant_phone' => 'required',
            ]);

            if ($validator->fails()) 
            {
                return redirect()->back()
                ->withInput($request->all())
                ->withErrors(
                    [
                        'representant_phone' => $validator->errors()->first('representant_phone'),
                    ]
                );
            }

            session()->put('representant.phone',$request->get('representant_phone'));
            session()->put('register_wizard.representant_exist_phone',1);

        }


        //ingresa numero de celular
        if ($request->has('is_representant_mobile')) {
            
            $validator = Validator::make($request->all(),[
                'representant_mobile' => 'required',
            ]);

            if ($validator->fails()) 
            {
                return redirect()->back()
                ->withInput($request->all())
                ->withErrors(
                    [
                        'representant_mobile' => $validator->errors()->first('representant_mobile'),
                    ]
                );
            }

            session()->put('representant.mobile',$request->get('representant_mobile'));
            session()->put('register_wizard.representant_exist_mobile',1);

        } 

        //ingresa correo Electronico
        if ($request->has('is_representant_email')) {
            
            $validator = Validator::make($request->all(),[
                'representant_email' => 'required|email',
            ],[
                'representant_email.email' => 'Correo Inválido'
            ]);

            if ($validator->fails()) 
            {
                return redirect()->back()
                ->withInput($request->all())
                ->withErrors(
                    [
                        'representant_email' => $validator->errors()->first('representant_email'),
                    ]
                );
            }

            session()->put('representant.email',$request->get('representant_email'));
            session()->put('register_wizard.representant_exist_email',1);

        }


        //ingresa correo Electronico
        if ($request->has('is_representant_address')) {
            
            $validator = Validator::make($request->all(),[
                'representant_address' => 'required',
            ],[
                'representant_address.required' => 'Dirección Requerida'
            ]);

            if ($validator->fails()) 
            {
                return redirect()->back()
                ->withInput($request->all())
                ->withErrors(
                    [
                        'representant_address' => $validator->errors()->first('representant_address'),
                    ]
                );
            }

            session()->put('representant.address',$request->get('representant_email'));
            session()->put('register_wizard.representant_exist_address',1);

        }

        //ingresa nombre del niño
        if ($request->has('is_children_name')) {
            
            $validator = Validator::make($request->all(),[
                'children_name' => 'required',
            ],[
                'children_name.required' => 'Nombre del niño(a) requerida'
            ]);

            if ($validator->fails()) 
            {
                return redirect()->back()
                ->withInput($request->all())
                ->withErrors(
                    [
                        'children_name' => $validator->errors()->first('children_name'),
                    ]
                );
            }

            session()->put('children.name',$request->get('children_name'));
            session()->put('register_wizard.children_exist_name',1);

        }

        //ingresa apellido del niño
        if ($request->has('is_children_last_name')) {
            
            $validator = Validator::make($request->all(),[
                'children_last_name' => 'required',
            ],[
                'children_last_name.required' => 'Apellido del niño(a) requerida'
            ]);

            if ($validator->fails()) 
            {
                return redirect()->back()
                ->withInput($request->all())
                ->withErrors(
                    [
                        'children_last_name' => $validator->errors()->first('children_last_name'),
                    ]
                );
            }

            session()->put('children.last_name',$request->get('children_last_name'));
            session()->put('register_wizard.children_exist_last_name',1);

        }

        //ingresa nickaname del niño
        if ($request->has('is_children_nickname')) {
            
            $validator = Validator::make($request->all(),[
                'children_nickname' => 'required',
            ],[
                'children_nickname.required' => 'Nickname del niño(a) requerida'
            ]);

            if ($validator->fails()) 
            {
                return redirect()->back()
                ->withInput($request->all())
                ->withErrors(
                    [
                        'children_nickname' => $validator->errors()->first('children_nickname'),
                    ]
                );
            }

            session()->put('children.nickname',$request->get('children_nickname'));
            session()->put('register_wizard.children_exist_nickname',1);

        }

        //ingresa historia clinica del niño
        if ($request->has('is_children_medical_history')) {
            
            $validator = Validator::make($request->all(),[
                'children_medical_history' => 'required',
            ],[
                'children_medical_history.required' => 'Historial Médico del niño(a) requerido(a)'
            ]);

            if ($validator->fails()) 
            {
                return redirect()->back()
                ->withInput($request->all())
                ->withErrors(
                    [
                        'children_medical_history' => $validator->errors()->first('children_medical_history'),
                    ]
                );
            }

            session()->put('children.medical_history',$request->get('children_medical_history'));
            session()->put('register_wizard.children_exist_medical_history',1);

        }

        //ingresa fb del representant
        if ($request->has('is_representant_facebook_link')) {
            
            $validator = Validator::make($request->all(),[
                'representant_facebook_link' => 'string',
            ],[
                'representant_facebook_link.string' => 'Enlace de Fb No ingresado'
            ]);

            if ($validator->fails()) 
            {
                return redirect()->back()
                ->withInput($request->all())
                ->withErrors(
                    [
                        'representant_facebook_link' => $validator->errors()->first('representant_facebook_link'),
                    ]
                );
            }

            session()->put('representant.facebook_link',$request->get('representant_facebook_link'));
            session()->put('register_wizard.representant_exist_facebook_link',1);

        }

        //ingresa el tipo de classe
        if ($request->has('is_group_children_class_type')) {
            
            $validator = Validator::make($request->all(),[
                'group_class_type' => 'required',
            ],[
                'group_class_type.required' => 'Ingrese un tipo de clase'
            ]);

            if ($validator->fails()) 
            {
                return redirect()->back()
                ->withInput($request->all())
                ->withErrors(
                    [
                        'group_class_type' => $validator->errors()->first('group_class_type'),
                    ]
                );
            }

            session()->put('group_class_student.type',$request->get('group_class_type'));
            session()->put('register_wizard.group_class_exist_group',1);

        }

         //ingresa el tipo de classe
        if ($request->has('is_children_age')) {
            
            $validator = Validator::make($request->all(),[
                'children_age' => 'required',
            ],[
                'children_age.required' => 'Seleccione una edad del niño(a)'
            ]);

            if ($validator->fails()) 
            {
                return redirect()->back()
                ->withInput($request->all())
                ->withErrors(
                    [
                        'children_age' => $validator->errors()->first('children_age'),
                    ]
                );
            }

            session()->put('children.age',$request->get('children_age'));
            session()->put('register_wizard.children_exist_age',1);

        }

        //ingresa una fecha disponible para la clase
        if ($request->has('is_date_for_class')) {
            
            $validator = Validator::make($request->all(),[
                'group_class_date' => 'required|date',
            ],[
                'group_class_date.required' => 'Seleccione una fecha para la clase',
                'group_class_date.date' => 'Seleccione una fecha válida',
            ]);

            if ($validator->fails()) 
            {
                return redirect()->back()
                ->withInput($request->all())
                ->withErrors(
                    [
                        'group_class_date' => $validator->errors()->first('group_class_date'),
                    ]
                );
            }

            session()->put('group_class_student.date',$request->get('group_class_date'));
            session()->put('register_wizard.group_exist_date',1);

        }

        return redirect()->back();
    }
}
