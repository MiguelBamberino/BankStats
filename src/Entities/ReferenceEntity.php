<?php

namespace BankStats\Entities;

use PPCore\Entities\RelationalEntity;
use PPCore\Collections\SimpleCollection;

use PPCore\ValidationRules\StringRule;

class ReferenceEntity extends RelationalEntity{
  
  protected $name;
  protected $who;
  
      public static function buildValidationRules(SimpleCollection $rules){
        parent::buildValidationRules($rules);
        $rules->set('name',new StringRule(true,1));
        $rules->set('who',new StringRule(true,1));
    }
}