<?php
namespace HappyFeet\Repository;

use HappyFeet\RepositoryInterface\AgeRangeRepositoryInterface;
use HappyFeet\Exceptions\AgeRangeException;
use HappyFeet\Models\AgeRange;


/**
* 
*/
class AgeRangeRepository implements AgeRangeRepositoryInterface
{
	
	public function paginate()
	{
		return AgeRange::paginate();
	}

	public function enum($params = null)
	{
		if ($params) {
			if (is_array($params) && array_key_exists('name', $params)) {
				
				$ranges = AgeRange::where('name',$params['name'])->get();
				 
			}
		} else {
			$ranges = AgeRange::get();
		}

		if (!$ranges) {
			throw new AgeRangeException('No se han encontrado el listado de  rangos de edades',404);
		}
		return $ranges;
	}



	public function find($field)
	{
		if (is_array($field)) {

			if (array_key_exists('name', $field)) { 
				$ageRange = AgeRange::where('name',$field['name'])->first();	
			} else {

				throw new AgeRangeException('No se puede buscar el rango de edades',404);	
			}

		} elseif (is_string($field) || is_int($field)) {
			$ageRange = AgeRange::where('id',$field)->first();
		} else {
			throw new AgeRangeException('Se ha producido un error el rango de edades',500);	
		}

		if (!$ageRange) throw new AgeRangeException('No se puede buscar el rango de edades',404);	
		
		return $ageRange;

	}

	//TODO
	public function save($data)
	{
		$ageRange = new AgeRange();
		$ageRange->fill($data);
		if ($ageRange->save()) {
			$key = $ageRange->getKey();
			return  $this->find($key);
		} else {
			throw new AgeRangeException('Ha ocurrido un error al guardar el rango de edades '.$data['name'],500);
		}		
	}

	public function edit($id,$data)
	{
		$ageRange = AgeRange::find($id);
		if ($ageRange) {
			$ageRange->fill($data);
			if($ageRange->update()){
				$key = $ageRange->getKey();
				return $this->find($key);
			}
		} else {
			throw new AgeRangeException('Ha ocurrido un error al actualizar el rango de edades '.$data['name'],500);
		}


	}

	public function remove($id)
	{
		if ($AgeRange = $this->find($id)) {
			$AgeRange->delete();
			return true;
		}
		throw new AgeRangeException('Ha ocurrido un error al eliminar el módulo ',500);
	}

	public function getModel()
	{
		return new AgeRange();
	}


	// public function loadMenu($userId)
	// {
	// 	$query  = AgeRange::select('AgeRange.*')->with(['permissions'=>function($query) use($userId){
	// 					$query->selectRaw('distinct permission.*')
	// 					->leftJoin('permission_role as rPer','rPer.permission_id','=','permission.id')
	// 					->leftJoin('user_role as rolU','rolU.role_id','=','rPer.role_id')
	// 					->leftJoin('user as usr','usr.id','=','rolU.user_id')
	// 					->whereRaw('usr.id = "'.$userId.'" and permission.type_id = (select id from permission_type where permission_type.code = "menu" and permission.parent_id is null)')
	// 					->orderBy('permission.order')
	// 					->with(['children'=>function($query) use($userId){
	// 						$query->select('permission.*')
	// 						->leftJoin('permission_role as rPer','rPer.permission_id','=','permission.id')
	// 						->leftJoin('user_role as rolU','rolU.role_id','=','rPer.role_id')
	// 						->leftJoin('user as usr','usr.id','=','rolU.user_id')
	// 						->whereRaw('usr.id = "'.$userId.'" and permission.type_id = (select id from permission_type where permission_type.code = "menu")')
	// 						->orderBy('permission.order')
	// 						->get();
	// 					}])
	// 					->get();
	// 				}])
	// 				->leftJoin('permission as parent','parent.AgeRange_id','=','AgeRange.id')
	// 				->leftJoin('permission as child','child.parent_id','=','parent.id')
	// 				->whereRaw("AgeRange.state=1 and AgeRange.id in (SELECT per.AgeRange_id FROM permission per left JOIN permission_role rPer ON rPer.permission_id = per.id left join user_role rolU on rolU.role_id = rPer.role_id left join user on `user`.id = rolU.user_id where user.id = ".$userId.") and parent.type_id = (select id from permission_type where code = 'menu')")
	// 				->groupBy('AgeRange.name')
	// 				->orderBy('AgeRange.order')
	// 				->orderBy('parent.order')
	// 				->get();
	// 	return $query;
	// }


	// public function loadAdminMenu()
	// {
	// 	$query = AgeRange::select('AgeRange.*')->with(['permissions'=>function($query){
	// 		$query->selectRaw('distinct permission.* ')
	// 		->whereRaw('permission.type_id = (select id from permission_type where permission_type.code = "menu")')
	// 		->whereNull('permission.parent_id')
	// 		->with(['children'=>function($query){
	// 			$query->select('permission.*')
	// 			->whereRaw('permission.type_id = (select id from permission_type where permission_type.code = "menu")')
	// 			->orderBy('permission.order')
	// 			->get();
	// 		}])->orderBy('permission.order')->get();
	// 	}])
	// 	->whereRaw('AgeRange.state=1 ')
	// 	->leftJoin('permission as parent','parent.AgeRange_id','=','AgeRange.id')
	// 	->groupBy('AgeRange.name')
	// 	->orderBy('AgeRange.order')
	// 	->orderBy('parent.order')
	// 	->get();
	// 	return $query;
	// }

	public function getRangeSecuence()
	{
		$rangeAges = AgeRange::selectRaw(" min(min_age) min_age, max(max_age) max_age  ")->first();

		$ages  = [];
		
		for ($i= $rangeAges->min_age; $i <= $rangeAges->max_age; $i++) { 
			$ages[$i] = $i;	
		}

		if (count($ages) == 0) {
			throw new AgeRangeException('No se ha podido cargar el rango de edades',500);
		}

		if (!$rangeAges) {
			throw new AgeRangeException('No existen rangos de edades disponibles',500);
		}
		return $ages;
		
	}
}