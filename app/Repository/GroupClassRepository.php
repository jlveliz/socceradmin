<?php
namespace Futbol\Repository;

use Futbol\RepositoryInterface\GroupClassRepositoryInterface;
use Futbol\Exceptions\GroupClassException;
use Futbol\Models\GroupClass;

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
					$groups = GroupClass::where('name',$params['name'])->get();
				}
			}elseif(is_string($params) || is_int($params)) {
				$groups = GroupClass::where('field_id',$params)->get();
			}

		}  else {
			$groups = GroupClass::with('coach')->all();
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


	public function removeGroupBySchedule($data) {

		$groupClass = GroupClass::where('day',$data['day'])
						->where('schedule_field_parent',$data['schedule'])
						->where('field_id',$data['field_id'])
						->get();
		$deleteds = false;
		if(count($groupClass) > 0) {
			foreach ($groupClass as $key => $group) {
				if($group->delete()) {
					$deleteds = true;
				} else {
					$deleteds = true;
				}
			}
		}

		return $deleteds ;

	}

	/*
		Get all groups by a field_id
	*/ 
	public function enumByField($fieldId) {
		
		// $groups = $this->enum($fieldId);
		$groups = GroupClass::with('coach','range')->where('state',GroupClass::ACTIVE)->where('disponibility','>',\DB::raw(0))->where('field_id',$fieldId)->get();
		foreach($groups as $group) {
			$group->day = days_of_week()[$group->day];
		}

		return $groups;

	}


	public function findByFieldAndDay($fieldId,$keyDay) {
		$group = GroupClass::where('field_id',$fieldId)->where('day',$keyDay)->where('state',GroupClass::ACTIVE)->get();
		if (!$group) {
			throw new GroupClassException('Ha ocurrido un error al encontrar el grupo el grupo ',500);
		}
		return $group;
	}


	public function getAvailableDayByField($fieldId)
	{
		$days = GroupClass::selectRaw(" distinct day ")->where("state",GroupClass::ACTIVE)->where('disponibility','>',0)->where('field_id',$fieldId)->get();
		if (count($days) > 0) {
			return $days;
		}

		throw new GroupClassException("Ha ocurrido un error al encontrar los días", 500);
		
	}


	public function getAvailableHourDay($keyDay, $fieldId)
	{
		$hours = GroupClass::selectRaw(" distinct schedule ")->where("state",GroupClass::ACTIVE)->where('disponibility','>',0)->where('field_id',$fieldId)->where('day',$keyDay)->get();
		
		if (count($hours) > 0) {
			$startHours = [];
			foreach ($hours as $key => $value) {
				if (count($startHours) == 0 || !array_key_exists($value->schedule['start'], $startHours))  {	
					$startHours[$value->schedule['start']]  = $value->schedule['start'];
				}
			}

			return $startHours;
		}

		throw new GroupClassException("Ha ocurrido un error al encontrar las horas disponibles", 500);
	}
}