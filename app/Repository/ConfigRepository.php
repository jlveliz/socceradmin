<?php
namespace HappyFeet\Repository;

use HappyFeet\RepositoryInterface\ConfigRepositoryInterface;
use HappyFeet\Exceptions\ConfigException;

/**
* 
*/
class ConfigRepository implements ConfigRepositoryInterface
{
	
	public function enum($params = null)
	{
		$configs = Config::all();

		if (!$configs) {
			throw new ConfigException('No se han encontrado el listado de  configuraciones',404);
		}
		return $configs;
	}



	public function find($field)
	{
		if (is_array($field)) {

			if (array_key_exists('key', $field)) { 
				$config = Config::where('key',$field['key'])->first();	
			} else {

				throw new ConfigException('No se puede buscar la configuración',404);	
			}

		} elseif (is_string($field) || is_int($field)) {
			$config = Config::where('id',$field)->first();
		} else {
			throw new ConfigException('Se ha producido un error al buscar la configuración',404);	
		}

		if (!$config) throw new ConfigException('No se puede buscar la configuración',404);	
		
		return $config;

	}

	//TODO
	public function save($data)
	{
		$config = new Config();
		$config->fill($data);
		if ($config->save()) {
			$key = $config->getKey();
			return  $this->find($key);
		} else {
			throw new ConfigException('Ha ocurrido un error al guardar el módulo '.$data['key'].'',500);
		}		
	}

	public function edit($id,$data)
	{
		$config = Config::find($id);
		if ($config) {
			$config->fill($data);
			if($config->update()){
				$key = $config->getKey();
				return $this->find($key);
			}
		} else {
			throw new ConfigException('Ha ocurrido un error al actualizar el módulo '.$data['key'].'',500);
		}


	}

	public function remove($id)
	{
		if ($config = $this->find($id)) {
			$config->delete();
			return true;
		}
		throw new ConfigException('Ha ocurrido un error al eliminar la configuración ',500);
	}
}