<?php
namespace Futbol\RepositoryInterface;

// use Futbol\RespositoryInterface\CoreRepositoryInterface;


interface ModuleRepositoryInterface extends CoreRepositoryInterface {
	
	public function loadMenu($userId);
}