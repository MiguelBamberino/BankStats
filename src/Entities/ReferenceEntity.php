<?php

namespace BankStats\Entities;

use PPCore\Entities\RelationalEntity;
use PPCore\Collections\SimpleCollection;
use PPCore\Collections\RelationshipRules;

use PPCore\ValidationRules\StringRule;

use BankStats\Helpers\RepoEnum;

class ReferenceEntity extends RelationalEntity{

    public $tagLinks;
    public $tags;

    protected $name;
    protected $who;

    public static function buildRelationshipRules(RelationshipRules $rules) {
        parent::buildRelationshipRules($rules);
        $rules->hasMany(  RepoEnum::ReferenceToTag ,'tagLinks','reference_id');
		$rules->hasManyToMany(  RepoEnum::Tag ,'tags',RepoEnum::ReferenceToTag,'reference_id','tag');

    }

    public static function buildValidationRules(SimpleCollection $rules){
        parent::buildValidationRules($rules);
        $rules->set('name',new StringRule(true,1));
        $rules->set('who',new StringRule(true,1));

    }
}