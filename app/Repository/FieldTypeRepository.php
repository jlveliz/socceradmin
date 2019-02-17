<?php
namespace HappyFeet\Repository;

use HappyFeet\RepositoryInterface\FieldTypeRepositoryInterface;
use HappyFeet\Exceptions\FieldTypeException;
use HappyFeet\Models\FieldType;


/**
* 
*/
class FieldTypeRepository implements FieldTypeRepositoryInterface
{
	
	public function paginate()
	{
		return FieldType::paginate();
	}

	public function enum($params = null)
	{
		if ($params) {
			if (is_array($params) && array_key_exists('name', $params)) {
				$types = FieldType::where('name',$params['name'])->get();			 
			}
		} else {
			$types = FieldType::get();
		}

		if (!$types) {
			throw new FieldTypeException('No se han encontrado el listado de tipos cancha',404);
		}
		return $types;
	}



	public function find($field)
	{
		if (is_array($field)) {

			if (array_key_exists('name', $field)) { 
				$type = FieldType::where('name',$field['name'])->first();	
			} else {

				throw new FieldTypeException('No se puede buscar el tipo de cancha',404);	
			}

		} elseif (is_string($field) || is_int($field)) {
			$type = FieldType::where('id',$field)->first();
		} else {
			throw new FieldTypeException('Se ha producido un error el tipo de cancha',500);	
		}

		if (!$type) throw new FieldTypeException('No se puede buscar el tipo de cancha',404);	
		
		return $type;

	}

	//TODO
	public function save($data)
	{
		$type = new FieldType();
		$type->fill($data);
		if ($type->save()) {
			$key = $type->getKey();
			return  $this->find($key);
		} else {
			throw new FieldTypeException('Ha ocurrido un error al guardar el tipo de cancha '.$data['name'],500);
		}		
	}

	public function edit($id,$data)
	{
		$type = FieldType::find($id);
		if ($type) {
			$type->fill($data);
			if($type->update()){
				$key = $type->getKey();
				return $this->find($key);
			}
		} else {
			throw new FieldTypeException('Ha ocurrido un error al actualizar el tipo de cancha '.$data['name'],500);
		}


	}

	public function remove($id)
	{
		if ($type = $this->find($id)) {
			$type->delete();
			return true;
		}
		throw new FieldTypeException('Ha ocurrido un error al eliminar el módulo ',500);
	}

	public function getModel()
	{
		return new FieldType();
	}
}