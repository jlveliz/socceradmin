<?php
namespace Futbol\Repository;

use Futbol\RepositoryInterface\CoachRepositoryInterface;
use Futbol\Exceptions\CoachException;
use Futbol\Models\Coach;
use Futbol\Models\Person;
use Futbol\Models\Role;
use Futbol\Models\PersonType;
use DB;

/**
* 
*/
class CoachRepository implements CoachRepositoryInterface
{
	
	public function paginate()
	{
		return Coach::paginate();
	}

	public function enum($params = null)
	{
		
		if ($params) {
			if (array_key_exists('state', $params)) {
				$coachs = Coach::where('state',$params['state'])->get();
			}
		} else {
			$coachs = Coach::all();
		}

		if (!$coachs || !isset($coachs)) {
			throw new CoachException('No se han encontrado el listado de  coachs',"404");
		}
		return $coachs;
	}



	public function find($field)
	{
		if(is_int($field) || is_string($field)) {
			$coach = Coach::where('id',$field)->first();
		} else {
			throw new CoachException('Se ha producido un error al buscar el coach',"500");	
		}

		if (!$coach) throw new CoachException('No se puede buscar el coach',"404");	
		
		return $coach;

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
			$coach = new Coach();
			$coach->fill($data);
			if ($saved = $coach->save()) {
				$data['roles'] = $this->getDefaultRole();
				$coach->roles()->sync($data['roles']);
				
				$key = $coach->getKey();
				return  $this->find($key);
			}
		} else {
			throw new RoleException(['title'=>'Ha ocurrido un error al guardar el usuario '.$data['username'].'','detail'=>'Intente nuevamente o comuniquese con el administrador','level'=>'error'],"500");
		}
		
	}

	public function edit($id,$data)
	{
		
		$data['person_type_id'] = $this->getPersonType();
		$coach = $this->find($id);
		if ($coach) {
			if(!is_null($data['password'])) {
				$data['password'] = \Hash::make($data['password']); 
   			} else {
   				unset($data['password']);
   			}
   			
   			$coach->person->fill($data)->update();
			$coach->fill($data);
			if($coach->update()){
				$key = $coach->getKey();
				$coach =  $this->find($key);
				return $coach;
			}
		} else {
			throw new RoleException(['title'=>'Ha ocurrido un error al actualizar el coach '.$data['username'].'','detail'=>'Intente nuevamente o comuniquese con el administrador','level'=>'error'],"500");
		}
	}

	public function remove($id)
	{
		if ($coach = $this->find($id)) {
			$coach->delete();
			return true;
		}
		throw new UserException(['title'=>'Ha ocurrido un error al eliminar el coach ','detail'=>'Intente nuevamente o comuniquese con el administrador','level'=>'error'],"500");
		
	}

	public function getModel()
	{
		return new Coach();
	}

	public function getDefaultRole()
	{
		$roles = Role::without('permissions')->select('role.id')->where('code',Coach::ROLE)->orWhere('code',Coach::ALTROLE)->get()->toArray();
		$newRoles = [];
		foreach ($roles as $keyRole => $valueRole) {
			$newRoles[] = $valueRole['id'];
		}
		return $newRoles;
	}

	public function getPersonType($code = null) {
        return PersonType::select('id')->where('code', $code ? $code : 'persona-natural' )->first()->id;
    }
}