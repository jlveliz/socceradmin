<?php
namespace HappyFeet\Repository;

use HappyFeet\RepositoryInterface\AssistanceRepositoryInterface;
use HappyFeet\Exceptions\AssistanceException;
use HappyFeet\Models\Assistance;
use DB;

/**
* 
*/
class AssistanceRepository implements AssistanceRepositoryInterface
{
	
	public function paginate()
	{
		return Assistance::paginate();
	}

	public function enum($params = null)
	{
		if ($params) {
			
			if(is_array($params)) {

				if (array_key_exists('name', $params)) {
					return Assistance::where('name',$params['name'])->get();
				}

			} 
		} else {
			$fields = Assistance::all();
		}

		if (!$fields) {
			throw new AssistanceException('No se han encontrado el listado de asistencias',404);
		}
		return $fields;
	}



	public function find($field)
	{
		if (is_array($field)) {
			if (array_key_exists('name', $field)) { 
				$field = Assistance::where('name',$field['name'])->first();	
			} else {

				throw new AssistanceException('No se puede buscar la asistencia',404);	
			}

		} elseif (is_string($field) || is_int($field)) {
			$field = Assistance::where('id',$field)->first();
		} else {
			throw new AssistanceException('Se ha producido un error al buscar la asistencia',500);	
		}

		if (!$field) throw new AssistanceException('No se puede buscar la asistencia',404);	
		
		return $field;

	}

	//TODO
	public function save($data)
	{
		$field = new Assistance();
		$field->fill($data);
		if ($field->save()) {
			$key = $field->getKey();
			return  $this->find($key);
		} else {
			throw new AssistanceException('Ha ocurrido un error al guardar la asistencia '.$data['name'],500);
		}		
	}

	public function edit($id,$data)
	{
		$field = Assistance::find($id);
		if ($field) {
			$field->fill($data);
			if($field->update()){
				return $this->find($key);
			}
		} else {
			throw new AssistanceException('Ha ocurrido un error al actualizar la asistencia '.$data['name'],500);
		}


	}

	public function remove($id)
	{
		if ($field = $this->find($id)) {
			$field->delete();
			return true;
		}
		throw new AssistanceException('Ha ocurrido un error al eliminar la asistencia ',500);
	}

	public function getModel()
	{
		return new Assistance();
	}


	public function getAssistanceByGroup($params){
		
		$assistances = DB::select("
							SELECT 
								
							FROM 
							enrollment

						")->get();

	}
}