<?php
namespace Futbol\RepositoryInterface;



interface StudentRepositoryInterface extends CoreRepositoryInterface {

	public function getTotalStudents();

	public function insertFromRegisterForm($data);
	
}