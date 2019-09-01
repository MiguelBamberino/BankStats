<?php

namespace BankStats\Entities;

use PPCore\Entities\RelationalEntity;
use PPCore\Collections\SimpleCollection;

use PPCore\ValidationRules\IntegerRule;

class ReferenceToTagEntity extends RelationalEntity{
  
  public $reference;
  public $tag;
  
  protected $reference_id;
  protected $tag_id;
  
      public static function buildValidationRules(SimpleCollection $rules){
        parent::buildValidationRules($rules);
        $rules->set('reference_id',new IntegerRule(true,1));
        $rules->set('tag_id',new IntegerRule(true,1));
    }
}