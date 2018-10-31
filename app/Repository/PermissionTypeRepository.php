<?php
namespace HappyFeet\Repository;

use HappyFeet\RepositoryInterface\PermissionTypeRepositoryInterface;
use HappyFeet\Exceptions\PermissionTypeException;
use HappyFeet\Models\PermissionType;

/**
* 
*/
class PermissionTypeRepository implements PermissionTypeRepositoryInterface
{
	
	public function enum($params = null)
	{
		$tPermissions = PermissionType::all();

		if (!$tPermissions) {
			throw new PermissionTypeException('No se han encontrado el listado de tipos de permisos',404);
		}
		return $tPermissions;
	}



	public function find($field)
	{
		if (is_array($field)) {
			if (array_key_exists('name', $field)) { 
				$tPermission = PermissionType::where('name',$field['name'])->first();	
			} else {

				throw new PermissionTypeException('No se puede buscar el tipo de permiso',404);	
			}

		} elseif (is_string($field) || is_int($field)) {
			$tPermission = PermissionType::where('id',$field)->first();
		} else {
			throw new PermissionTypeException('Se ha producido un error al buscar el tipo permiso',500);	
		}

		if (!$tPermission) throw new PermissionTypeException('No se puede buscar al tipo permiso',404);	
		
		return $tPermission;

	}

	//TODO
	public function save($data)
	{
		$tPermission = new PermissionType();
		$tPermission->fill($data);
		if ($tPermission->save()) {
			$key = $tPermission->getKey();
			return  $this->find($key);
		} else {
			throw new PermissionTypeException('Ha ocurrido un error al guardar el tipo de permiso '.$data['name'],500);
		}		
	}

	public function edit($id,$data)
	{
		$tPermission = PermissionType::find($id);
		if ($tPermission) {
			$tPermission->fill($data);
			if($tPermission->update()){
				$key = $tPermission->getKey();
				return $this->find($key);
			}
		} else {
			throw new PermissionTypeException('Ha ocurrido un error al actualizar el tipo de permiso '.$data['name'],500);
		}


	}

	public function remove($id)
	{
		if ($tPermission = $this->find($id)) {
			$tPermission->delete();
			return true;
		}
		throw new PermissionTypeException('Ha ocurrido un error al eliminar el tipo de permiso ',500);
	}
}