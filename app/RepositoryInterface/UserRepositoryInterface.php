<?php
namespace HappyFeet\RepositoryInterface;

// use HappyFeet\RespositoryInterface\CoreRepositoryInterface;


interface UserRepositoryInterface extends CoreRepositoryInterface {

	public function getPersonType();	
}