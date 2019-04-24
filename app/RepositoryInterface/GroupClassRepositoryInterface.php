<?php
namespace HappyFeet\RepositoryInterface;


interface GroupClassRepositoryInterface extends CoreRepositoryInterface {
    
    public function removeGroupBySchedule($data);
    public function enumByField($fieldId);    
    public function findByFieldAndDay($fieldId,$keyDay);
    public function getAvailableDayByField($fieldId);
    public function getAvailableHourDay($keyDay, $fieldId);
}