<?php
namespace HappyFeet\Repository;

use HappyFeet\RepositoryInterface\RoleRepositoryInterface;
use HappyFeet\Exceptions\RoleException;
use HappyFeet\Models\Role;

/**
* 
*/
class RoleRepository implements RoleRepositoryInterface
{
	
	public function paginate()
	{
		return Role::paginate();
	}

	public function enum($params = null)
	{
		$roles = Role::all();

		if (!$roles) {
			throw new RoleException('No se han encontrado el listado de roles',404);
		}
		return $roles;
	}



	public function find($field)
	{
		if (is_array($field)) {
			if (array_key_exists('name', $field)) { 
				$role = Role::with('permissions')->where('name',$field['name'])->first();	
			} else {

				throw new RoleException('No se puede buscar el rol',404);	
			}

		} elseif (is_string($field) || is_int($field)) {
			$role = Role::with('permissions')->where('id',$field)->first();
		} else {
			throw new RoleException('Se ha producido un error al buscar el rol',500);	
		}

		if (!$role) throw new RoleException('No se puede buscar al rol',404);	
		
		return $role;

	}

	//TODO
	public function save($data)
	{
		$role = new Role();
		$role->fill($data);
		if ($role->save()) {
			if (array_key_exists('permissions', $data)) {
				$role->permissions()->sync($data['permissions']);
			}
			$key = $role->getKey();
			return  $this->find($key);
		} else {
			throw new RoleException('Ha ocurrido un error al guardar el rol '.$data['name'],500);
		}		
	}

	public function edit($id,$data)
	{
		$role = $this->find($id);
		if ($role) {
			$role->fill($data);
			if($role->update()){
				if (array_key_exists('permissions', $data)) {
					$role->permissions()->sync($data['permissions']);
				}
				$key = $role->getKey();
				return $this->find($key);
			}
		} else {
			throw new RoleException('Ha ocurrido un error al actualizar el rol '.$data['name'],500);
		}


	}

	public function remove($id)
	{
		if ($role = $this->find($id)) {
			$role->delete();
			return true;
		}
		throw new RoleException('Ha ocurrido un error al eliminar el rol ',500);
	}

	public function getModel()
	{
		return new Role();
	}
}