<?php
namespace HappyFeet\RepositoryInterface;


interface SeasonRepositoryInterface extends CoreRepositoryInterface {	

	public function getMonthForSeason($id);
	
}