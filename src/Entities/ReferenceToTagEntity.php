<?php

namespace BankStats\Entities;

use PPCore\Entities\RelationalEntity;
use PPCore\Collections\RelationshipRules;
use PPCore\Collections\SimpleCollection;

use PPCore\ValidationRules\IntegerRule;

use BankStats\Helpers\RepoEnum;

class ReferenceToTagEntity extends RelationalEntity{
  
    public $reference;
    public $tag;

    protected $reference_id;
    protected $tag_id;

    public static function buildRelationshipRules(RelationshipRules $rules) {
        parent::buildRelationshipRules($rules);
        $rules->belongsTo(  RepoEnum::Reference ,'reference','reference_id');
        $rules->belongsTo(  RepoEnum::Tag ,'tag','tag_id');

    }
    public static function buildValidationRules(SimpleCollection $rules){
        parent::buildValidationRules($rules);
        $rules->set('reference_id',new IntegerRule(true,1));
        $rules->set('tag_id',new IntegerRule(true,1));
    }
}