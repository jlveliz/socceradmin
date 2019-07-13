<?php
namespace Futbol\RepositoryInterface;


interface AssistanceRepositoryInterface extends CoreRepositoryInterface {
	public function saveMany($data);
}