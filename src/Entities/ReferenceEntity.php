<?php

namespace BankStats\Entities;

use PPCore\Entities\RelationalEntity;
use PPCore\Collections\SimpleCollection;
use PPCore\Collections\EntityCollection;
use PPCore\Collections\RelationshipRules;
use PPCore\ValidationRules\StringRule;

use BankStats\Helpers\RepoEnum;
use BankStats\Entities\ReferenceToTagEntity;

class ReferenceEntity extends RelationalEntity{

    public $tagLinks;
    public $tags;

    protected $name;
    protected $who;

  public function updateTags(EntityCollection $tags){
    
    // if id int and tagLinks null then EXC
    // if id NULL create collection for tagLinks
    
    // key taglinks by tag id
    // key tags by id
    
    // foreach tag
      // if tagLink ! in tags
          // delete link
    
    // foreach tag
      // if tag id null
        // add link + tag inside link
      // else if tag not in links
        // add to links + tag in link
    
      $this->updateHaveMtM($tags);
  }
  public function updateHaveMtM(EntityCollection $new_items){
    
      // check existing links have been populated
    if( $this->id && !($this->tagLinks instanceof EntityCollection) ){
        throw new BadEntityStateException("tagLinks must be populated to update 'many to many' links.");
    }
      // we have are in a new entity, not saved to persistence yet
    if( !$this->id && !($this->tagLinks instanceof EntityCollection) ){
        $this->tagLinks = new EntityCollection("BankStats\Entities\ReferenceToTagEntity");
    }
    // make collections search easy
    $new_ids = $new_items->pluck('id');
    $this->tagLinks = $this->tagLinks->keyBy('tag_id');
    // remove links not being kept  
    foreach($this->tagLinks as $item){
      if( in_array($item->tag_id,$new_ids)==false){
        $this->tagLinks->get($item->tag_id)->setStatus(0);
      }
    }
    $this->tags->emptyOut();
    foreach($new_items as $item){
      // if tag is new or we dont already have it then add it
      if( !$item->id || $this->tagLinks->has($item->id)==false ){
          $link = new ReferenceToTagEntity();
          $link->tag = $item;
          $this->tagLinks->push($link);
          $this->tags->push($item);
      }  
    }
    
  }
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