<?php
namespace HappyFeet\RepositoryInterface;


interface GroupClassRepositoryInterface extends CoreRepositoryInterface {
    
    public function removeGroupBySchedule($data);
    
}