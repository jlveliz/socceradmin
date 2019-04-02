<?php
namespace HappyFeet\RepositoryInterface;


interface AssistanceCoachRepositoryInterface extends CoreRepositoryInterface {

	public function loadDaysMonth($month, $fieldId, $coachsId);
	
}