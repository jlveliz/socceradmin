<?php
namespace HappyFeet\Repository;

use HappyFeet\RepositoryInterface\StudentRepositoryInterface;
use HappyFeet\Exceptions\StudentException;
use HappyFeet\Models\Student;
use HappyFeet\Models\Role;

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
		$person = new Person();
		$data['person_type_id'] = $this->getPersonType();
		$person->fill($data);
		if ($person->save()) {
			$personId = $person->getKey();
			$data['password'] = \Hash::make($data['password']);
			$data['person_id'] = $personId;
			$student = new Student();
			$student->fill($data);
			if ($saved = $student->save()) {
				// if (array_key_exists('roles', $data)) {
				// 	$student->roles()->sync($data['roles']);
				// }
				// $key = $student->getKey();
				return  $this->find($key);
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