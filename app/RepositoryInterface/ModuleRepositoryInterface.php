<?php
namespace HappyFeet\RepositoryInterface;

// use HappyFeet\RespositoryInterface\CoreRepositoryInterface;


interface ModuleRepositoryInterface extends CoreRepositoryInterface {
	
	public function loadMenu($userId);
}