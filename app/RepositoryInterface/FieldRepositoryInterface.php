<?php
namespace HappyFeet\RepositoryInterface;


interface FieldRepositoryInterface extends CoreRepositoryInterface {

    public function findSchedule($id);


    public function getNumActives();
	
}