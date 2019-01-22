<?php
namespace HappyFeet\Repository;

use HappyFeet\RepositoryInterface\StudentRepositoryInterface;
use HappyFeet\Exceptions\StudentException;
use HappyFeet\Models\Student;
use HappyFeet\Models\Person;
use HappyFeet\Models\PersonType;
use HappyFeet\Models\Role;
use HappyFeet\Models\User;
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
		//begin transaction
		// DB::beginTransaction();

		//save person representant
		$dataRepresentant = $data['representant'];
		// dd($dataRepresentant);
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
			// DB::rollBack();
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
			// DB::rollBack();
			throw new StudentException('Ha ocurrido un error al guardar el estudiante '.$data['name'],"500");
		}


		if(!$existPersonRepresentant) {
			//Set Role Representante
			$roleId = Role::where('code','representant')->first()->id;
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
				return  $this->find($student->getKey());
			} else {
				// DB::rollBack();
				throw new StudentException('Ha ocurrido un error al guardar el estudiante '.$data['name'],"500");
			}
		} else {
			// DB::rollBack();
			throw new StudentException('Ha ocurrido un error al guardar el estudiante '.$data['name'],"500");
		}

		// DB::commit();
		
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
			throw new StudentException('Ha ocurrido un error al actualizar el estudiante '.$data['name'],"500");
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