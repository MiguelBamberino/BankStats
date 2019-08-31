<?php

namespace BankStats\Repositories;

use PPCore\Repositories\RelationalRepository;

class ReferenceRepository extends RelationalRepository{
  
    protected $location = 'BankStats/references';
    protected $defaultEntityClass = 'ReferenceEntity';
  
}