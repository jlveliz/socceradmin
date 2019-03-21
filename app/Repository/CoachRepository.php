<?php
namespace HappyFeet\Repository;

use HappyFeet\RepositoryInterface\CoachRepositoryInterface;
use HappyFeet\Exceptions\CoachException;
use HappyFeet\Models\Coach;

/**
* 
*/
class CoachRepository implements CoachRepositoryInterface
{
	
	public function paginate()
	{
		return Coach::paginate();
	}

	public function enum($params = null)
	{
		$coachs = Coach::all();

		if (!$coachs) {
			throw new CoachException('No se han encontrado el listado de  coachs',"404");
		}
		return $coachs;
	}



	public function find($field)
	{
		if(is_int($field) || is_string($field)) {
			$coach = Coach::where('id',$field)->first();
		} else {
			throw new CoachException('Se ha producido un error al buscar el coach',"500");	
		}

		if (!$coach) throw new CoachException('No se puede buscar el coach',"404");	
		
		return $coach;

	}

	//TODO
	public function save($data)
	{
		
		
	}

	public function edit($id,$data)
	{
		

	}

	public function remove($id)
	{
		
	}

	public function getModel()
	{
		return new Coach();
	}
}