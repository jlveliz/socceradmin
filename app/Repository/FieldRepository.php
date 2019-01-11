<?php
namespace HappyFeet\Repository;

use HappyFeet\RepositoryInterface\FieldRepositoryInterface;
use HappyFeet\Exceptions\FieldException;
use HappyFeet\Models\GroupClass;
use HappyFeet\Models\Field;
use DB;

/**
* 
*/
class FieldRepository implements FieldRepositoryInterface
{
	
	public function paginate()
	{
		return Field::paginate();
	}

	public function enum($params = null)
	{
		if ($params) {
			
			if(is_array($params)) {

				if (array_key_exists('name', $params)) {
					return Field::where('name',$params['name'])->get();
				}

			} 
		} else {
			$fields = Field::all();
		}

		if (!$fields) {
			throw new FieldException('No se han encontrado el listado de canchas',404);
		}
		return $fields;
	}



	public function find($field)
	{
		if (is_array($field)) {
			if (array_key_exists('name', $field)) { 
				$field = Field::where('name',$field['name'])->first();	
			} else {

				throw new FieldException('No se puede buscar la cancha',404);	
			}

		} elseif (is_string($field) || is_int($field)) {
			$field = Field::where('id',$field)->first();
		} else {
			throw new FieldException('Se ha producido un error al buscar la cancha',500);	
		}

		if (!$field) throw new FieldException('No se puede buscar la cancha',404);	
		
		return $field;

	}

	//TODO
	public function save($data)
	{
		$field = new Field();
		$field->fill($data);
		if ($field->save()) {
			$key = $field->getKey();
			return  $this->find($key);
		} else {
			throw new FieldException('Ha ocurrido un error al guardar la cancha '.$data['name'],500);
		}		
	}

	public function edit($id,$data)
	{
		$field = Field::find($id);
		if ($field) {
			$field->fill($data);
			if($field->update()){
				$key = $field->getKey();
				
				//groups
				if(array_key_exists('groups',$data)) {
					foreach($data['groups'] as $kday => $schedules) {
						if(array_key_exists($kday,days_of_week())) {
							foreach ($schedules as $schedule) {
								foreach($schedule as $groupData) {
									
									$existGr = false;
									
									if(isset($groupData['id']) && $groupData['id'] != null) {
										$existGr = true;
										$grModel = GroupClass::find($groupData['id']);
									} else {
										$grModel = new GroupClass();
									}

									$grModel->fill($groupData);

									if($existGr) {
										$grModel->update();
									} else {
										$grModel->save();
									}

								}
							}
						}
					}
				}
				return $this->find($key);
			}
		} else {
			throw new FieldException('Ha ocurrido un error al actualizar la cancha '.$data['name'],500);
		}


	}

	public function remove($id)
	{
		if ($field = $this->find($id)) {
			$field->delete();
			return true;
		}
		throw new FieldException('Ha ocurrido un error al eliminar la cancha ',500);
	}

	public function getModel()
	{
		return new Field();
	}


	public function findSchedule($id){
		$field = $this->find($id);
		if($field) {
			$formatted = [];
			$schedule = $field->available_days;
			
			foreach($schedule as $kday => $item ) {
				
				$formatted[$kday] = [
					'label' => days_of_week()[$kday],
					'schedule' => $item
				];
			}
			

			return $formatted;

		}
		return false;
	}
}