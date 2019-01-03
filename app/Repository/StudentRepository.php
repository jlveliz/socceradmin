<?php
namespace HappyFeet\Repository;

use HappyFeet\RepositoryInterface\StudentRepositoryInterface;
use HappyFeet\Exceptions\StudentException;
use HappyFeet\Models\Student;
use HappyFeet\Models\Person;
use HappyFeet\Models\PersonType;
use HappyFeet\Models\Role;
use HappyFeet\Models\User;

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
			throw new StudentException(['title'=>'No se han encontrado el listado de  estudiantes','detail'=>'Intente nuevamente o comuniquese con el administrador','level'=>'error'],"404");
		}
		return $users;
	}



	public function find($field)
	{
		if(is_int($field) || is_string($field)) {
			$student = Student::where('id',$field)->first();
		} else {
			throw new StudentException(['title'=>'Se ha producido un error al buscar el estudiante','detail'=>'Intente nuevamente o comuniquese con el administrador','level'=>'error'],"500");	
		}

		if (!$student) throw new StudentException(['title'=>'No se puede buscar al estudiante','detail'=>'Intente nuevamente o comuniquese con el administrador','level'=>'error'],"404");	
		
		return $student;

	}

	//TODO
	public function save($data)
	{
		//save student
		$person = new Person();
		$data['person_type_id'] = $this->getPersonType();
		$person->fill($data);
		if ($person->save()) {
			$personId = $person->getKey();
			$student = new Student();
			$data['person_id'] = $personId;
			$student->fill($data);
			if ($saved = $student->save()) {
				//save representant
				$existRepresentant = false;
				if (($data['representant_user_id'] != null) && ($data['representant_person_id'] != null ) ) {
					$representant = Person::find($data['representant_person_id']);
					$existRepresentant = true;
				} else {
					$representant = new Person();
				}
				
				$representant->person_type_id = $this->getPersonType();
				$representant->num_identification = $data['representant_num_identification'];
				$representant->name = $data['representant_name'];
				$representant->last_name = $data['representant_last_name'];
				$representant->address = $data['representant_address'];
				$representant->phone = $data['representant_phone'];
				$representant->mobile = $data['representant_phone'];
				$representant->genre = $data['representant_genre'];
				$representant->date_birth = $data['representant_date_birth'];
				$representant->activity = $data['representant_activity'];
				
				if($representant->save()) {
					//save user representant
					$dataUser = [];
					if ($existRepresentant) {
						$userRepresentant = User::find($data['representant_user_id']);
					} else {
						$userRepresentant = new User();
						$dataUser['password'] = (new User())->generateGenericPass();
					}
					
					$userRepresentant->person_id = $representant->getKey();
					$userRepresentant->email = $data['representant_email'];
					$userRepresentant->username = str_slug($data['representant_name'].''.$data['representant_last_name']);
					$existRepresentant ? $userRepresentant->update() : $userRepresentant->save();
					
					//Set Role Representante
					$roleId = Role::where('code','representant')->first()->id;
					$userRepresentant->roles()->attach($roleId);
					//set representant id to student
					$student->representant_id = $userRepresentant->getKey();
					$student->save();
					return  $this->find($student->getKey());
					
				}		
		} else {
			throw new StudentException(['title'=>'Ha ocurrido un error al guardar el estudiante '.$data['name'].'','detail'=>'Intente nuevamente o comuniquese con el administrador','level'=>'error'],"500");
		}
		
		} else {
			throw new StudentException(['title'=>'Ha ocurrido un error al guardar el estudiante '.$data['name'].'','detail'=>'Intente nuevamente o comuniquese con el administrador','level'=>'error'],"500");
		}
		
	}

	public function edit($id,$data)
	{
		$data['person_type_id'] = $this->getPersonType();
		$student = $this->find($id);
		if ($student) {
			if(!is_null($data['password'])) {
				$data['password'] = \Hash::make($data['password']); 
   			} else {
   				unset($data['password']);
   			}
   			$student->person->fill($data)->update();
			$student->fill($data);
			if($student->update()){
				// if (array_key_exists('roles', $data)) {
				// 	$student->roles()->sync($data['roles']);
				// }
				$key = $student->getKey();
				$student =  $this->find($key);
				return $student;
			}
		} else {
			throw new StudentException(['title'=>'Ha ocurrido un error al actualizar el estudiante '.$data['name'].'','detail'=>'Intente nuevamente o comuniquese con el administrador','level'=>'error'],"500");
		}


	}

	public function remove($id)
	{
		if ($student = $this->find($id)) {
			$student->delete();
			return true;
		}
		throw new StudentException(['title'=>'Ha ocurrido un error al eliminar el estudiante ','detail'=>'Intente nuevamente o comuniquese con el administrador','level'=>'error'],"500");
	}

	public function getModel()
	{
		return new Student();
	}


	public function getPersonType($code = null) {
        return PersonType::select('id')->where('code', $code ? $code : 'persona-natural' )->first()->id;
    }
}