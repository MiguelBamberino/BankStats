<?php

namespace BankStats\Repositories;

use PPCore\Repositories\RelationalRepository;

class TagRepository extends RelationalRepository{
  
    protected $location = 'BankStats/tags';
    protected $defaultEntityClass = 'TagEntity';
  
}