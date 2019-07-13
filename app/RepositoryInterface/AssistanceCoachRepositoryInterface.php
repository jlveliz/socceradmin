<?php
namespace Futbol\RepositoryInterface;


interface AssistanceCoachRepositoryInterface extends CoreRepositoryInterface {

	public function loadDaysMonth($month, $fieldId, $coachsId);
	
}