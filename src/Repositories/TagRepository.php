<?php

namespace BankStats\Repositories;

use PPCore\Repositories\RelationalRepository;

class TagRepository extends RelationalRepository{
  
    protected $location = 'BankStats/tags';
    protected $defaultEntityClass = 'TagEntity';
    
    public function getLookup(){
      $this->keyBy('tag');
      return $this->getMany();
    }
}