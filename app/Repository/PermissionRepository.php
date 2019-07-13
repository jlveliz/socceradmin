<?php
namespace Futbol\Repository;

use Futbol\RepositoryInterface\PermissionRepositoryInterface;
use Futbol\Exceptions\PermissionException;
use Futbol\Models\Permission;
use DB;

/**
* 
*/
class PermissionRepository implements PermissionRepositoryInterface
{
	
	public function paginate()
	{
		return Permission::paginate();
	}

	public function enum($params = null)
	{
		if ($params) {
			
			if(is_array($params)) {

				if (array_key_exists('state', $params)) {
					return Permission::where('state',$params['state'])->get();
				}

			} else {
				$permissions = Permission::where('type_id','=',DB::raw('( select id from permission_type where code = "'.$params["type"].'")'))->get();
			}
		} else {
			$permissions = Permission::all();
		}

		if (!$permissions) {
			throw new PermissionException('No se han encontrado el listado de permisos',404);
		}
		return $permissions;
	}



	public function find($field)
	{
		if (is_array($field)) {
			if (array_key_exists('name', $field)) { 
				$permission = Permission::where('name',$field['name'])->first();	
			} else {

				throw new PermissionException('No se puede buscar el permiso',404);	
			}

		} elseif (is_string($field) || is_int($field)) {
			$permission = Permission::where('id',$field)->first();
		} else {
			throw new PermissionException('Se ha producido un error al buscar el permiso',500);	
		}

		if (!$permission) throw new PermissionException('No se puede buscar al permiso',404);	
		
		return $permission;

	}

	//TODO
	public function save($data)
	{
		$permission = new Permission();
		$permission->fill($data);
		if ($permission->save()) {
			$key = $permission->getKey();
			return  $this->find($key);
		} else {
			throw new PermissionException('Ha ocurrido un error al guardar el permiso '.$data['name'],500);
		}		
	}

	public function edit($id,$data)
	{
		$permission = Permission::find($id);
		if ($permission) {
			$permission->fill($data);
			if($permission->update()){
				$key = $permission->getKey();
				return $this->find($key);
			}
		} else {
			throw new PermissionException('Ha ocurrido un error al actualizar el permiso '.$data['name'],500);
		}


	}

	public function remove($id)
	{
		if ($permission = $this->find($id)) {
			$permission->delete();
			return true;
		}
		throw new PermissionException('Ha ocurrido un error al eliminar el permiso ',500);
	}

	public function getModel()
	{
		return new Permission();
	}
}