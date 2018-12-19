<?php
namespace HappyFeet\Repository;

use HappyFeet\RepositoryInterface\RepresentantRepositoryInterface;
use HappyFeet\Exceptions\RepresentantException;
use HappyFeet\Models\Representant;
use HappyFeet\Models\Person;
use DB;

/**
* 
*/
class RepresentantRepository implements RepresentantRepositoryInterface
{
	
	public function enum($params = null)
	{
		
		$representants = Representant::all();
		
		if (!$representants) {
			throw new RepresentantException('No se han encontrado el listado de permisos',404);
		}
		return $representants;
	}



	public function find($field)
	{
		if (is_array($field)) {
			if (array_key_exists('num_identification', $field)) { 
				$identification = $field['num_identification'];
				 return  Representant::select('representant.*')->join('user','user.id','=','representant.user_id')
				                 ->join('person','person.id','=','user.person_id')
				                 ->where('person.num_identification','=',$identification)->first();
				// return Representant::find(1);

			} else {
				throw new RepresentantException('No se puede buscar el representante con cédula '.$field['num_identification'] ,404);	
			}

		} elseif (is_string($field) || is_int($field)) {
			$representant = Representant::where('id',$field)->first();
		} else {
			throw new RepresentantException('Se ha producido un error al buscar el representante',500);	
		}

		if (!$representant) throw new RepresentantException('No se puede buscar el representante',404);	
		
		return $representant;

	}

	//TODO
	public function save($data)
	{
		$representant = new Representant();
		$representant->fill($data);
		if ($representant->save()) {
			$key = $representant->getKey();
			return  $this->find($key);
		} else {
			throw new RepresentantException('Ha ocurrido un error al guardar el representante ' . $data['name']. ' ' .  $data['last_name'],500);
		}		
	}

	public function edit($id,$data)
	{
		$representant = Representant::find($id);
		if ($representant) {
			$representant->fill($data);
			if($representant->update()){
				$key = $representant->getKey();
				return $this->find($key);
			}
		} else {
			throw new RepresentantException('Ha ocurrido un error al actualizar el representante '.$data['name'].' ' . $data['last_name'],500);
		}


	}

	public function remove($id)
	{
		if ($representant = $this->find($id)) {
			$representant->delete();
			return true;
		}
		throw new RepresentantException('Ha ocurrido un error al eliminar el permiso ',500);
	}

	public function getModel()
	{
		return new Representant();
	}

	public function paginate()
	{
		return Representant::paginate();
	}
}