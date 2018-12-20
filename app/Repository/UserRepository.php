<?php
namespace HappyFeet\Repository;

use HappyFeet\RepositoryInterface\UserRepositoryInterface;
use HappyFeet\Exceptions\UserException;
use HappyFeet\Models\User;
use HappyFeet\Models\Person;
use HappyFeet\Models\PersonType;
/**
* 
*/
class UserRepository implements UserRepositoryInterface
{
	
	public function paginate()
	{
		return User::paginate();
	}

	public function enum($params = null)
	{
		$users = User::all();

		if (!$users) {
			throw new UserException(['title'=>'No se han encontrado el listado de  usuarios','detail'=>'Intente nuevamente o comuniquese con el administrador','level'=>'error'],"404");
		}
		return $users;
	}



	public function find($field)
	{
		if (is_array($field)) {

			if (array_key_exists('username', $field)) { 
				
			} else {

				throw new UserException(['title'=>'No se puede buscar al usuario','detail'=>'Intente nuevamente o comuniquese con el administrador','level'=>'error'],"404");	
			}
			

		} elseif (is_string($field) || is_int($field)) {
			$user = User::where('id',$field)->first();
		} else {
			throw new UserException(['title'=>'Se ha producido un error al buscar el usuario','detail'=>'Intente nuevamente o comuniquese con el administrador','level'=>'error'],"500");	
		}

		if (!$user) throw new UserException(['title'=>'No se puede buscar al usuario','detail'=>'Intente nuevamente o comuniquese con el administrador','level'=>'error'],"404");	
		
		return $user;

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
			$user = new User();
			$user->fill($data);
			if ($user->save()) {
				$user->roles()->sync($data['roles']);
				$key = $user->getKey();
				return  $this->find($key);
		} else {
			throw new UserException(['title'=>'Ha ocurrido un error al guardar el usuario '.$data['username'].'','detail'=>'Intente nuevamente o comuniquese con el administrador','level'=>'error'],"500");
		}
		
		} else {
			throw new UserException(['title'=>'Ha ocurrido un error al guardar el usuario '.$data['username'].'','detail'=>'Intente nuevamente o comuniquese con el administrador','level'=>'error'],"500");
		}
		
	}

	public function edit($id,$data)
	{
		$data['person_type_id'] = $this->getPersonType();
		$user = $this->find($id);
		if ($user) {
			if(!empty($data['password'])) {
				$data['password'] = \Hash::make($data['password']); 
   			}
   			$user->person->fill($data)->update();
			$user->fill($data);
			if($user->update()){
				$user->roles()->sync($data['roles']);
				$user->permissions()->delete();
				$user->permissions()->createMany($data['permissions']);
				$key = $user->getKey();
				$user =  $this->find($key);
				return $user;
			}
		} else {
			throw new UserException(['title'=>'Ha ocurrido un error al actualizar el usuario '.$data['username'].'','detail'=>'Intente nuevamente o comuniquese con el administrador','level'=>'error'],"500");
		}


	}

	public function remove($id)
	{
		if ($user = $this->find($id)) {
			$user->delete();
			return true;
		}
		throw new UserException(['title'=>'Ha ocurrido un error al eliminar el usuario ','detail'=>'Intente nuevamente o comuniquese con el administrador','level'=>'error'],"500");
	}

	public function getModel()
	{
		return new User();
	}
}