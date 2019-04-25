<?php
namespace HappyFeet\RepositoryInterface;



interface StudentRepositoryInterface extends CoreRepositoryInterface {

	public function getTotalStudents();

	public function insertFromRegisterForm($data);
	
}