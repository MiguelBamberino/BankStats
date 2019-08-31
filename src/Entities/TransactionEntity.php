<?php

namespace BankStats\Entities;

use PPCore\Entities\RelationalEntity;
use PPCore\Collections\SimpleCollection;

use PPCore\ValidationRules\IntegerRule;
use PPCore\ValidationRules\FloatRule;
use PPCore\ValidationRules\MySQLDateTimeRule;

class TransactionEntity extends RelationalEntity{
  
  public $reference;
  public $tags;
  
  protected $reference_id;
  protected $amount;
  protected $date;
  
      public static function buildValidationRules(SimpleCollection $rules){
        parent::buildValidationRules($rules);
        $rules->set('reference_id',new IntegerRule(true,1));
        $rules->set('amount',new FloatRule(true));
        $rules->set('date',new MySQLDateTimeRule(true));
    }
}