<?php
namespace HappyFeet\Repository;

use HappyFeet\RepositoryInterface\GroupClassRepositoryInterface;
use HappyFeet\Exceptions\GroupClassException;
use HappyFeet\Models\GroupClass;

/**
* 
*/
class GroupClassRepository implements GroupClassRepositoryInterface
{
	
	public function paginate()
	{
		return GroupClass::paginate();
	}

	public function enum($params = null)
	{
		if ($params) {			
			if(is_array($params)) {
				if (array_key_exists('name', $params)) {
					return GroupClass::where('name',$params['name'])->get();
				}
			} 
		} else {
			$groups = GroupClass::all();
		}

		if (!$groups) {
			throw new GroupClassException('No se han encontrado el listado de Grupos',404);
		}
		return $groups;
	}



	public function find($field)
	{
		if (is_array($field)) {
			if (array_key_exists('name', $field)) { 
				$field = GroupClass::where('name',$field['name'])->first();	
			} else {

				throw new GroupClassException('No se puede buscar el grupo',404);	
			}

		} elseif (is_string($field) || is_int($field)) {
			$field = GroupClass::where('id',$field)->first();
		} else {
			throw new GroupClassException('Se ha producido un error al buscar el grupo',500);	
		}

		if (!$field) throw new GroupClassException('No se puede buscar el grupo',404);	
		
		return $field;

	}

	//TODO
	public function save($data)
	{
		$field = new GroupClass();
		$field->fill($data);
		if ($field->save()) {
			$key = $field->getKey();
			return  $this->find($key);
		} else {
			throw new GroupClassException('Ha ocurrido un error al guardar el grupo '.$data['name'],500);
		}		
	}

	public function edit($id,$data)
	{
		$field = GroupClass::find($id);
		if ($field) {
			$field->fill($data);
			if($field->update()){
				$key = $field->getKey();
				return $this->find($key);
			}
		} else {
			throw new GroupClassException('Ha ocurrido un error al actualizar el grupo '.$data['name'],500);
		}


	}

	public function remove($id)
	{
		if ($field = $this->find($id)) {
			$field->delete();
			return true;
		}
		throw new GroupClassException('Ha ocurrido un error al eliminar el grupo ',500);
	}

	public function getModel()
	{
		return new GroupClass();
	}
}