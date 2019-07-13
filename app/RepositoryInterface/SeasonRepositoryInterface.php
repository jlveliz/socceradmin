<?php
namespace Futbol\RepositoryInterface;


interface SeasonRepositoryInterface extends CoreRepositoryInterface {	

	public function getMonthForSeason($id = null);
	
}