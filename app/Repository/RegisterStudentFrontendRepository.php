<?php
namespace HappyFeet\Repository;

use HappyFeet\RepositoryInterface\RegisterStudentFrontendRepositoryInterface;
use HappyFeet\Models\Representant;
use HappyFeet\Models\Student;
use Exception;

/**
 * 
 */
class RegisterStudentFrontendRepository implements RegisterStudentFrontendRepositoryInterface
{
	
	public function save($data)
	{
		// dd($data);
		$representantId = null;
		$StudentId = null;

		if (isset($data['representant']) && !empty($data['representant']) ) {
			
			$representant = new Representant();
			$representant->fill($data['representant']);
			if ($representant->save()) {
				$representantId = $representant->getKey();

			}else {
				throw new Exception("Error al insertar el representante, intente nuevamente", 500);
				
			}

		}


		if (isset($data['Student']) && !empty($data['Student'])) {
			
			$Student = new Student();
			$Student->fill($data['Student']);
			if ($Student->save()) {
				$StudentId = $Student->getKey();
			}else {

				if ($representantId) {
					$representant->delete();
				}
				throw new Exception("Error al insertar el representante, intente nuevamente", 500);
				
			}
		}
	}
}