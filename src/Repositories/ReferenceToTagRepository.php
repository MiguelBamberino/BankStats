<?php

namespace BankStats\Repositories;

use PPCore\Repositories\RelationalRepository;

class ReferenceToTagRepository extends RelationalRepository{
  
    protected $location = 'BankStats/references_to_tags';
    protected $defaultEntityClass = 'ReferenceToTagEntity';
  
}