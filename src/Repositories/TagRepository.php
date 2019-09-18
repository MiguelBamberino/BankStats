<?php

namespace BankStats\Repositories;

use PPCore\Repositories\RelationalRepository;

class TagRepository extends RelationalRepository{
  
    protected $location = 'BankStats/tags';
    protected $defaultEntityClass = 'TagEntity';
    
    public function getSearchList(){
      $this->keyBy('tag');
      return $this->getMany();
    }
}