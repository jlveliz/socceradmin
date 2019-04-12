<?php
namespace HappyFeet\Repository;

use HappyFeet\RepositoryInterface\AssistanceRepositoryInterface;
use HappyFeet\Exceptions\AssistanceException;
use HappyFeet\Models\Assistance;
use HappyFeet\Models\Season;
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
			$assistances = Assistance::all();
		}

		if (!$assistances) {
			throw new AssistanceException('No se han encontrado el listado de asistencias',404);
		}
		return $assistances;
	}



	public function find($assistance)
	{
		if (is_array($assistance)) {
			if (array_key_exists('name', $assistance)) { 
				$assistance = Assistance::where('name',$assistance['name'])->first();	
			} else {

				throw new AssistanceException('No se puede buscar la asistencia',404);	
			}

		} elseif (is_string($assistance) || is_int($assistance)) {
			$assistance = Assistance::where('id',$assistance)->first();
		} else {
			throw new AssistanceException('Se ha producido un error al buscar la asistencia',500);	
		}

		if (!$assistance) throw new AssistanceException('No se puede buscar la asistencia',404);	
		
		return $assistance;

	}

	//TODO
	public function save($data)
	{
		$assistance = new Assistance();
		$assistance->fill($data);
		if ($assistance->save()) {
			$key = $assistance->getKey();
			return  $this->find($key);
		} else {
			throw new AssistanceException('Ha ocurrido un error al guardar la asistencia '.$data['name'],500);
		}		
	}

	public function edit($id,$data)
	{
		$assistance = Assistance::find($id);
		if ($assistance) {
			$assistance->fill($data);
			if($assistance->update()){
				$key = $assistance->getKey();
				return $this->find($key);
			}
		} else {
			throw new AssistanceException('Ha ocurrido un error al actualizar la asistencia',500);
		}


	}

	public function remove($id)
	{
		if ($assistance = $this->find($id)) {
			$assistance->delete();
			return true;
		}
		throw new AssistanceException('Ha ocurrido un error al eliminar la asistencia ',500);
	}

	public function getModel()
	{
		return new Assistance();
	}


	public function getAssistanceByGroup($params){
		
		$fieldId = $params['field'];
		$grId = $params['group_id'];
		$month = $params['month'];
		$day = $params['key_day'];
		$season = (new Season())->getSeasonActive();

		$startDate = new \DateTime($season->start_date);
        $endDate = new \DateTime($season->end_date);
        $interval = \DateInterval::createFromDateString('1 day');

        $period   = new \DatePeriod($startDate, $interval, $endDate);


        $datesAssistence = [];

		foreach ($period as $key => $dt) {
            //verify the day 
            if($dt->format('N') == num_days_of_week()[$day] && $dt->format('n') == $month) {
                $datesAssistence[] = $dt;
            }
        }
		

		
		$query =" SELECT DATE_FORMAT(en.created_at,'%Y-%m-%d') date_inscription,
					CONCAT( pe.`name`, ' ', pe.last_name ) student_name,
					pe.`id` student_id,
					concat( pe.age, ' Años' ) age,
					concat( re.`name`, ' ', re.last_name ) representant,
					gc.`day`,
					en.is_pay_inscription,
					en.is_pay_first_month,
					en.is_delivered_uniform,
					eg.id,";


		foreach ($datesAssistence as $key => $dateAssi) {
			$date = $dateAssi->format('Y-m-d');
			$query.="
					( SELECT ifnull( assistance.state, 0 ) FROM assistance WHERE assistance.enrollment_group_id= eg.id AND date = '$date' ) AS '$key' , ( SELECT assistance.id FROM assistance WHERE assistance.enrollment_group_id = eg.id AND date = '$date' ) AS id_$key ,
						( SELECT assistance.observation FROM assistance WHERE assistance.enrollment_group_id = eg.id AND date = '$date' ) AS comment_$key
					";

			if (($key+1) < count($datesAssistence)) {
             	$query.=" , ";
          	}
		}
		
		$query.="FROM enrollment en INNER JOIN student st ON en.student_id = st.id INNER JOIN person pe ON st.person_id = pe.id  INNER JOIN person re ON st.representant_id = re.id  INNER JOIN enrollment_groups eg ON en.id = eg.enrollment_id INNER JOIN group_class gc ON eg.group_id = gc.id  WHERE en.state = 1 AND en.season_id = 1 AND en.class_type = 2 AND gc.field_id = $fieldId AND gc.day = '$day' and st.deleted_at is null AND st.id > 0  AND re.id > 0 AND eg.group_id = $grId and en.deleted_at is null and st.deleted_at is null order by student_name;";

		
		$assistances = DB::select($query);
		return collect(['dates' =>$datesAssistence,'assistances' =>  $assistances]);
	}

	public function saveMany($assistances)
	{
		$allSuccess = false;
		foreach($assistances as $key => $assisFile) {
			$dataUpdate = [];
			foreach ($assisFile as $key => $Assistance) {
				
				if (array_key_exists('value',$Assistance)  && $Assistance['value'] == 'on') {	
					$dataUpdate['state'] = 1;
				} else {
					$dataUpdate['state'] = 0; 
					
				}
				
				$dataUpdate['observation'] = $Assistance['comment'];
				
				if($update = $this->edit($Assistance['assistance_id'],$dataUpdate)) {

					$allSuccess =  true;
				}
			}
			
		}
		if(!$allSuccess) {
			throw new AssistanceException('Ha ocurrido un error al actualizar la asistencia ',500);
		}
		
		return $allSuccess;
	}
}