<?php
namespace Futbol\RepositoryInterface;
/**
* 
*/
interface CoreRepositoryInterface 
{
	
	public function paginate();

	public function enum($params = null);

	public function find($id);

	public function save($data);

	public function edit($id,$data);

	public function remove($id);

	public function getModel();
}