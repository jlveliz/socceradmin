<?php
namespace HappyFeet\Repository;

use HappyFeet\RepositoryInterface\StudentRepositoryInterface;
use HappyFeet\Exceptions\StudentException;
use HappyFeet\Models\EnrollmentGroup;
use HappyFeet\Models\Student;
use HappyFeet\Models\Person;
use HappyFeet\Models\PersonType;
use HappyFeet\Models\Role;
use HappyFeet\Models\User;
use HappyFeet\Models\Enrollment;
use DB;

/**
* 
*/
class StudentRepository implements StudentRepositoryInterface
{
	
	public function paginate()
	{
		return Student::paginate();
	}

	public function enum($params = null)
	{
		$users = Student::all();

		if (!$users) {
			throw new StudentException('No se han encontrado el listado de  estudiantes',"404");
		}
		return $users;
	}



	public function find($field)
	{
		if(is_int($field) || is_string($field)) {
			$student = Student::where('id',$field)->first();
		} else {
			throw new StudentException('Se ha producido un error al buscar el estudiante',"500");	
		}

		if (!$student) throw new StudentException('No se puede buscar al estudiante',"404");	
		
		return $student;

	}

	//TODO
	public function save($data)
	{
		//save person representant
		$dataRepresentant = $data['representant'];
		
		$existPersonRepresentant = false;
		if (($dataRepresentant['user_id'] != null) && ($dataRepresentant['person_id'] != null ) ) {
			$personRepresentant = Person::find($dataRepresentant['person_id']);
			$existPersonRepresentant = true;
		} else {
			$personRepresentant = new Person();
		}
		
		$dataRepresentant['person_type_id'] = $this->getPersonType();
		$personRepresentant->fill($dataRepresentant);
		$existPersonRepresentant ? $savedPersonRepresentant = $personRepresentant->update() : $savedPersonRepresentant = $personRepresentant->save();
		if(!$savedPersonRepresentant) {
			throw new StudentException('Ha ocurrido un error al guardar el estudiante '.$data['name'],"500");
		}

		//insert person on data for user represenant
		$dataRepresentant['person_id'] = $personRepresentant->getKey();
		if ($existPersonRepresentant) {
			$userRepresentant = User::find($dataRepresentant['user_id']);
		} else {
			$userRepresentant = new User();
			$dataRepresentant['password'] = (new User())->generateGenericPass();
			
		}
		//save user representant
		$userRepresentant->fill($dataRepresentant);
		$existPersonRepresentant ? $savedUserRepresentant =  $userRepresentant->update() : $savedUserRepresentant = $userRepresentant->save();
		
		if(!$savedUserRepresentant) {
			throw new StudentException('Ha ocurrido un error al guardar el estudiante '.$data['name'],"500");
		}


		if(!$existPersonRepresentant) {
			//Set Role Representante
			$roleId = Role::where('code','representante')->first()->id;
			$userRepresentant->roles()->attach($roleId);
		}
		
		
		//save student
		$person = new Person();
		$data['person_type_id'] = $this->getPersonType();
		$person->fill($data);
		if ($person->save()) {
			$personId = $person->getKey();
			$student = new Student();
			$data['person_id'] = $personId;
			$data['representant_id'] = $personRepresentant->getKey();
			$student->fill($data);
			if ($saved = $student->save()) {
				
				//save Inscription
				$dataEnrollment = $data['enrollment'];
				// dd($dataEnrollment);
				$dataEnrollment['student_id'] = $student->getKey();
				$dataEnrollment['state'] = Enrollment::ACTIVE;
				$enrollment = new Enrollment();
				$enrollment->fill($dataEnrollment);

				if($saveEnrollment =  $enrollment->save() ) {
					//save groups
					foreach ($dataEnrollment['groups'] as $key => $gr) {
						$enrGroup = new EnrollmentGroup(['group_id' => $gr]);
						$enrollment->groups()->save($enrGroup);
					}
					return  $this->find($student->getKey());
				}
				
			} else {
				
				throw new StudentException('Ha ocurrido un error al guardar el estudiante '.$data['name'],"500");
			}
		} else {
			
			throw new StudentException('Ha ocurrido un error al guardar el estudiante '.$data['name'],"500");
		}
		
	}

	public function edit($id,$data)
	{
		//save person representant
		$dataRepresentant = $data['representant'];
		
		$existPersonRepresentant = false;
		if (($dataRepresentant['user_id'] != null) && ($dataRepresentant['person_id'] != null ) ) {
			$personRepresentant = Person::find($dataRepresentant['person_id']);
			$existPersonRepresentant = true;
		} else {
			$personRepresentant = new Person();
		}

		$dataRepresentant['person_type_id'] = $this->getPersonType();
		$personRepresentant->fill($dataRepresentant);
		$existPersonRepresentant ? $savedPersonRepresentant = $personRepresentant->update() : $savedPersonRepresentant = $personRepresentant->save();
		if(!$savedPersonRepresentant) {
			throw new StudentException('Ha ocurrido un error al actualizar el estudiante '.$data['name'],"500");
		}

		//insert person on data for user represenant
		$dataRepresentant['person_id'] = $personRepresentant->getKey();
		if ($existPersonRepresentant) {
			$userRepresentant = User::find($dataRepresentant['user_id']);
		} else {
			$userRepresentant = new User();
			$dataRepresentant['password'] = (new User())->generateGenericPass();
			
		}
		//save user representant
		$userRepresentant->fill($dataRepresentant);
		$existPersonRepresentant ? $savedUserRepresentant =  $userRepresentant->update() : $savedUserRepresentant = $userRepresentant->save();
		
		if(!$savedUserRepresentant) {
			throw new StudentException('Ha ocurrido un error al actualizar el estudiante '.$data['name'],"500");
		}

		if(!$existPersonRepresentant) {
			//Set Role Representante
			$roleId = Role::where('code','representante')->first()->id;
			$userRepresentant->roles()->attach($roleId);
		}



		//save student
		$student = Student::find($id);
		if(!$student) {
			throw new StudentException('Ha ocurrido un error al actualizar el estudiante '.$data['name'],"500");
		}

		$data['person_type_id'] = $this->getPersonType();
		$student->person->fill($data);
		if($savePerson = $student->person->update()) {
			$student->fill($data);
			if ($saveStudent = $student->save()) {
				$personId = $student->person->getKey();
				$data['person_id'] = $personId;
				$data['representant_id'] = $personRepresentant->getKey();
				$student->fill($data);
				
				//save Inscription
				$dataEnrollment = $data['enrollment'];
				$dataEnrollment['student_id'] = $student->getKey();
				$enrollment = $student->currentEnrollment();
				//$dataEnrollment['state'] = Enrollment::ACTIVE;
				//if change a group
				$updateGroupClass = false;
				if(array_key_exists('is_changing_group',$data) && $data['is_changing_group'] == '1') {
					$newGroups = $data['enrollment']['groups'];
					$oldGroups = $enrollment->replicate()->groups;
					$updateGroupClass = true;
				}
				$enrollment->fill($dataEnrollment);

				if($saveEnrollment =  $enrollment->save() ) {
					if($updateGroupClass) {
						$enrollment->updateCapacitiesGroups($oldGroups,$newGroups);
					}
					return  $this->find($student->getKey());
				}
					
				
			} else {
				
				throw new StudentException('Ha ocurrido un error al actualizar el estudiante '.$data['name'],"500");
			}
		}


	}

	public function remove($id)
	{
		if ($student = $this->find($id)) {
			$student->delete();
			return true;
		}
		throw new StudentException('Ha ocurrido un error al eliminar el estudiante ',"500");
	}

	public function getModel()
	{
		return new Student();
	}


	public function getPersonType($code = null) {
        return PersonType::select('id')->where('code', $code ? $code : 'persona-natural' )->first()->id;
    }
}