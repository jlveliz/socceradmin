<?php
namespace HappyFeet\Repository;

use HappyFeet\RepositoryInterface\SeasonRepositoryInterface;
use HappyFeet\Exceptions\SeasonException;
use HappyFeet\Models\Season;
use DB;

/**
* 
*/
class SeasonRepository implements SeasonRepositoryInterface
{
	
	public function paginate()
	{
		return Season::paginate();
	}

	public function enum($params = null)
	{
		if ($params) {
			
			if(is_array($params)) {

				if (array_key_exists('name', $params)) {
					return Season::where('name',$params['name'])->get();
				}
				
				if (array_key_exists('state', $params)) {
					return Season::where('state',$params['state'])->get();
				}

			} 
		} else {
			$modalities = Season::all();
		}

		if (!$modalities) {
			throw new SeasonException('No se han encontrado el listado de temporadas',404);
		}
		return $modalities;
	}



	public function find($param)
	{
		if (is_array($param)) {
			if (array_key_exists('name', $param)) { 
				$modality = Season::where('name',$param['name'])->first();	
			} else {
				throw new SeasonException('No se puede buscar la temporada',404);	
			}

		} elseif (is_string($param) || is_int($param)) {
			$modality = Season::where('id',$param)->first();
		} else {
			throw new SeasonException('Se ha producido un error al buscar la temporada',500);	
		}

		if (!$modality) throw new SeasonException('No se puede buscar la temporada',404);	
		
		return $modality;

	}

	//TODO
	public function save($data)
	{
		$modality = new Season();
		$modality->fill($data);
		if ($modality->save()) {
			$key = $modality->getKey();
			return  $this->find($key);
		} else {
			throw new SeasonException('Ha ocurrido un error al guardar la temporada '.$data['name'],500);
		}		
	}

	public function edit($id,$data)
	{
		$modality = Season::find($id);
		if ($modality) {
			$modality->fill($data);
			if($modality->update()){
				$key = $modality->getKey();
				return $this->find($key);
			}
		} else {
			throw new SeasonException('Ha ocurrido un error al actualizar la temporada '.$data['name'],500);
		}


	}

	public function remove($id)
	{
		if ($modality = $this->find($id)) {
			$modality->delete();
			return true;
		}
		throw new SeasonException('Ha ocurrido un error al eliminar la temporada ',500);
	}

	public function getModel()
	{
		return new Season();
	}


	public function findSchedule($id){
		$modality = $this->find($id);
		if($modality) {
			$formatted = [];
			$schedule = $modality->available_days;
			
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