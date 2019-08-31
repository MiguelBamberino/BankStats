<?php

namespace BankStats\Entities;

use PPCore\Entities\RelationalEntity;
use PPCore\Collections\SimpleCollection;

use PPCore\ValidationRules\StringRule;

class TagEntity extends RelationalEntity{
  
  protected $name;
  
      public static function buildValidationRules(SimpleCollection $rules){
        parent::buildValidationRules($rules);
        $rules->set('name',new StringRule(true,1));
    }
}