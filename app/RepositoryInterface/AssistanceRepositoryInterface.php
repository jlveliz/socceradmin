<?php
namespace HappyFeet\RepositoryInterface;


interface AssistanceRepositoryInterface extends CoreRepositoryInterface {
	public function saveMany($data);
}