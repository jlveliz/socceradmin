<?php
namespace HappyFeet\Repository;

use HappyFeet\RepositoryInterface\AssistanceCoachRepositoryInterface;
use HappyFeet\Exceptions\AssistanceCoachException;
use HappyFeet\Models\AssistanceCoach;

/**
* 
*/
class AssistanceCoachRepository implements AssistanceCoachRepositoryInterface
{
	
	public function paginate()
	{
		return AssistanceCoach::paginate();
	}

	public function enum($params = null)
	{
		if ($params) {
			
			if(is_array($params)) {

				if (array_key_exists('coach_id', $params)) {
					return AssistanceCoach::where('coach_id',$params['coach_id'])->get();
				}

			} 
		} else {
			$assistances = AssistanceCoach::all();
		}

		if (!$assistances) {
			throw new AssistanceCoachException('No se han encontrado el listado de asistencias de coachs',404);
		}
		return $assistances;
	}



	public function find($assistance)
	{
		if (is_array($assistance)) {
			if (array_key_exists('name', $assistance)) { 
				$assistance = AssistanceCoach::where('name',$assistance['name'])->first();	
			} else {

				throw new AssistanceCoachException('No se puede buscar la asistencia de coachs',404);	
			}

		} elseif (is_string($assistance) || is_int($assistance)) {
			$assistance = AssistanceCoach::where('id',$assistance)->first();
		} else {
			throw new AssistanceCoachException('Se ha producido un error al buscar la asistencia del coach',500);	
		}

		if (!$assistance) throw new AssistanceCoachException('No se puede buscar la asistencia del coach',404);	
		
		return $assistance;

	}

	//TODO
	public function save($data)
	{
		$assistance = new AssistanceCoach();
		$assistance->fill($data);
		if ($assistance->save()) {
			$key = $assistance->getKey();
			return  $this->find($key);
		} else {
			throw new AssistanceCoachException('Ha ocurrido un error al guardar la asistencia del coach ',500);
		}		
	}

	public function edit($id,$data)
	{
		$assistance = AssistanceCoach::find($id);
		if ($assistance) {
			$assistance->fill($data);
			if($assistance->update()){
				$key = $assistance->getKey();
				return $this->find($key);
			}
		} else {
			throw new AssistanceCoachException('Ha ocurrido un error al actualizar la asistencia del coach',500);
		}


	}

	public function remove($id)
	{
		if ($assistance = $this->find($id)) {
			$assistance->delete();
			return true;
		}
		throw new AssistanceCoachException('Ha ocurrido un error al eliminar la asistencia del coach',500);
	}

	public function getModel()
	{
		return new AssistanceCoach();
	}

	public function loadDaysMonth($month)
	{
		$numMonth = \DateTime::createFromFormat('m',$month);
		$numMonth2 = \DateTime::createFromFormat('m',$month);
		$startDateMonth = $numMonth->modify('first day of this month');
		$endDateMonth = $numMonth2->modify('last day of this month');
		dd($startDateMonth, $endDateMonth);
	}
}