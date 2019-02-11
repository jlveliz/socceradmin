<?php
namespace HappyFeet\RepositoryInterface;


interface GroupClassRepositoryInterface extends CoreRepositoryInterface {
    
    public function removeGroupBySchedule($data);
    public function enumByField($fieldId);    
    public function findByFieldAndDay($fieldId,$keyDay);    
}