<?php
namespace HappyFeet\Repository;

use HappyFeet\RepositoryInterface\RegisterStudentFrontendRepositoryInterface;
use HappyFeet\Models\Representant;
use HappyFeet\Models\Person;
use HappyFeet\Models\User;
use HappyFeet\Models\Student;
use Hash;
use Exception;

/**
 * 
 */
class RegisterStudentFrontendRepository implements RegisterStudentFrontendRepositoryInterface
{
	
	public function save($data)
	{
		if (isset($data['representant']) && !empty($data['representant']) ) {
			//save person
			$data['representant']['person_type_id'] = 1;
			$person = new Person();
			$person->fill($data['representant']);
			if ($person->save()) {
				$personId = $person->getKey();
				$password = Hash::make($person->num_identification);
				$dataUser = [
					'username' => $person->num_identification,
					'password' => $password,
					'person_id' => $personId,
					'state' => 0
				];
				//save user
				$user = new User();
				$user->fill($dataUser);
				if ($user->save()) {
					$userId = $user->getKey();
					//insert Representant
					$dataRepresentant = [
						'user_id' => $userId,
						'state' => 1
					];
					
					$representant = new Representant();
					$representant->fill($dataRepresentant);
					if($representant->save()) {
						$representantId = $representant->getKey();
						if (isset($data['children']) && !empty($data['children']) ) {
							//save children
							$personChild =  new Person();
							$dataStudentPerson = [
								'name' => $data['children']['name'],
								'last_name' => $data['children']['last_name'],
								'person_type_id' => 1,
								'age' =>  $data['children']['age']
							];
							$personChild->fill($dataStudentPerson);
							
							if ($personChild->save()) {
								
								$personChildId = $personChild->getKey();
								$student = new Student();
								$student->fill($data['chidren']);
								$student->representant_id = $representantId;
								$student->person_id = $personChildId;								
								if ($student->save()) {
									
									return true;

								} else {
									throw new Exception("Error al insertar el estudiante, intente nuevamente", 500);
								}
								
							} else {
								throw new Exception("Error al insertar el representante, intente nuevamente", 500);
							}


						} else {
							$representant = Representant::find($representantId);
							$representant->delete();
							throw new Exception("Error al insertar el representante, intente nuevamente", 500);
						}
						


					} else {
						$user = User::find($userId);
						$user->delete();
						throw new Exception("Error al insertar el representante, intente nuevamente", 500);
					}


				} else {
					$person = Person::find($personId);
					$person->delete();
					throw new Exception("Error al insertar el representante, intente nuevamente", 500);
				}
			}else {
				throw new Exception("Error al insertar el representante, intente nuevamente", 500);
				
			}

		}


		if (isset($data['Student']) && !empty($data['Student'])) {
			
			$Student = new Student();
			$Student->fill($data['Student']);
			if ($Student->save()) {
				$StudentId = $Student->getKey();
			}else {

				if ($representantId) {
					$representant->delete();
				}
				throw new Exception("Error al insertar el representante, intente nuevamente", 500);
				
			}
		}
	}
}