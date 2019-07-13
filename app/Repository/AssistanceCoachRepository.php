<?php
namespace Futbol\Repository;

use Futbol\RepositoryInterface\AssistanceCoachRepositoryInterface;
use Futbol\Repository\FieldRepository;
use Futbol\Exceptions\AssistanceCoachException;
use Futbol\Models\AssistanceCoach;

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
		
		if ($data['state'] == 2) {
			$data['state'] = 1;
		}

		if ($data['profit'] == 'NULL' || $data['profit'] == NULL) {
			$data['profit'] = 0;
		}

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
		
		if ($data['state'] == 2) {
			$data['state'] = 1;
		}

		if ($data['profit'] == 'NULL' || $data['profit'] == NULL) {
			$data['profit'] = 0;
		}

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

	public function loadDaysMonth($month, $fieldId, $coachsId)
	{
		$firstDate = \DateTime::createFromFormat('m',$month);
		$lastDate = \DateTime::createFromFormat('m',$month);
		$startDate = $firstDate->modify('first day of this month');
		$endDate = $lastDate->modify('last day of this month');
		$coachsId = explode(',', $coachsId);
		

		$fieldRepo = new FieldRepository();
		$field = $fieldRepo->find($fieldId);
		if ($field) {
			$keyDaysField = array_keys($field->available_days);

			$interval = \DateInterval::createFromDateString('1 day');

			$period = new \DatePeriod($startDate, $interval, $endDate);
			$days = [];
			$index = 0;
			foreach ($period as $keyDay => $dayPeriod) {
				$dayFormat = strtolower($dayPeriod->format('l'));
				$foundDay = array_search($dayFormat, $keyDaysField);
				if ($foundDay >= 0 && $foundDay !== false) {
					$days[$index] = [
						'day' => days_of_week()[$dayFormat] , 
						'date' => $dayPeriod->format('d'),
						'fulldate' => $dayPeriod->format('Y-m-d')
					];
					$days[$index]['coachs'] = [];
					for ($i=0; $i < count($coachsId) ; $i++) { 
						$days[$index]['coachs'][$i]['coach_id'] = $coachsId[$i];
						$days[$index]['coachs'][$i]['field_id'] = $field->id;

						//insert more data
						$existAssistance = AssistanceCoach::where('coach_id',$coachsId[$i])->where('date',$days[$index]['fulldate'])->where('field_id',$field->id)->first();
						$days[$index]['coachs'][$i]['profit'] = $existAssistance ? $existAssistance->profit : null; 
						$days[$index]['coachs'][$i]['state'] = $existAssistance ? $existAssistance->state : null;
						$days[$index]['coachs'][$i]['id'] = $existAssistance ? $existAssistance->id : null;
					}
					$index++;

				}
			}
			return $days;
		}
		
	}
}