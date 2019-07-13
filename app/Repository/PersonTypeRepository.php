<?php
namespace Futbol\Repository;

use Futbol\RepositoryInterface\PersonTypeRepositoryInterface;
use Futbol\Exceptions\PersonTypeException;
use Futbol\Models\PersonType;

/**
* 
*/
class PersonTypeRepository implements PersonTypeRepositoryInterface
{
	
	public function paginate()
	{
		return PersonType::paginate();
	}

	public function enum($params = null)
	{
		
		$personTypes = PersonType::orderBy('id')->get();
		
		if (!$personTypes) {
			throw new PersonTypeException('No se han encontrado el listado de tipos de persona',404);
		}
		return $personTypes;
	}



	public function find($field)
	{
		if (is_array($field)) {

			if (array_key_exists('name', $field)) { 
				$personType = PersonType::where('name',$field['name'])->first();	
			} else {

				throw new PersonTypeException('No se puede buscar el tipo de persona',404);	
			}

		} elseif (is_string($field) || is_int($field)) {
			$personType = PersonType::where('id',$field)->first();
		} else {
			throw new PersonTypeException('No se puede buscar el tipo de persona',500);	
		}

		if (!$personType) throw new PersonTypeException('No se puede buscar el tipo de persona',404);	
		
		return $personType;

	}

	//TODO
	public function save($data)
	{
		$personType = new PersonType();
		$personType->fill($data);
		if ($personType->save()) {
			$key = $personType->getKey();
			return  $this->find($key);
		} else {
			throw new PersonTypeException('Ha ocurrido un error al guardar el tipo de persona '.$data['name'],500);
		}		
	}

	public function edit($id,$data)
	{
		$personType = PersonType::find($id);
		if ($personType) {
			$personType->fill($data);
			if($personType->update()){
				$key = $personType->getKey();
				return $this->find($key);
			}
		} else {
			throw new PersonTypeException('Ha ocurrido un error al actualizar el tipo de persona '.$data['name'],500);
		}


	}

	public function remove($id)
	{
		if ($personType = $this->find($id)) {
			$personType->delete();
			return true;
		}
		throw new PersonTypeException('Ha ocurrido un error al eliminar el tipo de persona ',500);
	}

	public function getModel()
	{
		return new PersonType();
	}


	
}