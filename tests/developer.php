<?php

include __DIR__ ."/../vendor/autoload.php";


use PPCore\Adapters\DataSources\CSVDataSource;
use PPCore\Collections\Config;
use PPCore\Collections\EntityCollection;
use PPCore\RepositoryProvider;
use FileAdapter\Adapters\Local;

use BankStats\Entities\TagEntity;
use BankStats\Entities\ReferenceEntity;
use BankStats\Entities\ReferenceToTagEntity;
use BankStats\Entities\TransactionEntity;
use BankStats\Helpers\RepoEnum;

renderStartMenu();
exit;


function renderStartMenu(){
  initContainer();
  global $flash;
  system('clear');
  render("--- BankStats ---");
  
  render("");
  render($flash);$flash=null;
  render("");
  manageReferences();
  
}

function editTags($reference){
  $tags = implode(',',$reference->tags->pluck('name'));
  render("Current tags: ".$tags);
  $new = readline("What are the new tags ? :");
  // csv explode
  $tags = explode(",",$new);
  // look up ids
  // add new TagLinks
  // remove old ones
  var_dump($new);
}
function manageReferences(){
      
  ClearAndFlash();
  
  $service = PPServiceContainer()->get("BankStats\References");
  $list = $service->getList();
  renderReferenceList($list);
  
      render("[b] back | [x] edit tags");
    render("");
    $action = readline("action:");
    if(is_numeric($action)){
        editTags($list->get($action));
    }else{
        
    }
    system('clear');
    render("Action Success!");
    manageReferences();
  
}
function ClearAndFlash(){
  global $flash;
    system('clear');
    render("");
    render($flash);$flash=null;
}
function renderReferenceList($rows){
    
    render("");
    render("--- References ---");
    foreach($rows as $row){
        $tags = implode(',',$row->tags->pluck('name'));        
        $t = "[{$row->id}] {$row->name} - {$row->who} - tags({$tags})";
        render($t);
    }
    render("------------------");

}
function getRepoProvider(){
     $data = array(
      'starting_line'=>0,
      'headings_to_lowercase'=>false,
      'heading_spaces_to_underscore'=>false,
      'file_adapter'=>new Local(__DIR__.'/../data/'),
      'primary_key'=>'id',
    );
    $config = new Config($data);

    return new RepositoryProvider('CSVDataSource',$config);
}
function render($text,$colour="white"){
  echo $text."\n";
}
function debug2(){
  
  initContainer();
  $service = PPServiceContainer()->get("BankStats\References");
  $list = $service->getList();
  renderReferenceList($list);
}
function initContainer(){
         $data = array(
        'session'=>'off',
         'dataSource'=>array(
            'adapter'=>'CSVDataSource',
            'starting_line'=>0,
            'headings_to_lowercase'=>false,
            'heading_spaces_to_underscore'=>false,
            'file_adapter'=>new Local(__DIR__.'/../data/'),
            'primary_key'=>'id',
         )
        
    );
  $config = new Config($data);
  PPServiceContainer()->init($config);
}
function debug(){
   
    $tag = new TagEntity(array('name'=>'fuel'));
    $ref = new ReferenceEntity(array('id'=>54,'who'=>'teso','name'=>'Tesco LTD'));
    $ref2tag = new ReferenceToTagEntity(array('reference_id'=>1,'tag_id'=>3,));
    $trans = new TransactionEntity(array('reference_id'=>1,'amount'=>5.4,'date'=>'2018-09-02 00:00:00'));
    
    $tags = new EntityCollection("BankStats\Entities\TagEntity");
    $tags->push( new TagEntity(array('id'=>4,'name'=>'fuel')) );
    $tags->push( new TagEntity(array('id'=>5,'name'=>'coffee')) );
    $tags->push( new TagEntity(array('id'=>98,'name'=>'food')) );
    $tags->push( new TagEntity(array('id'=>null,'name'=>'eating-out')) );
  
    $ref->tagLinks = new EntityCollection("BankStats\Entities\ReferenceToTagEntity");
    $ref->tagLinks->push( new ReferenceToTagEntity(array('reference_id'=>54,'tag_id'=>3,'status'=>1,
                                                         'tag'=>new TagEntity(array('id'=>3,'name'=>'bills')) )) );
    $ref->tagLinks->push( new ReferenceToTagEntity(array('reference_id'=>54,'tag_id'=>5,'status'=>1,
                                                        'tag'=>new TagEntity(array('id'=>5,'name'=>'coffee')))) );
    $ref->tagLinks->push( new ReferenceToTagEntity(array('reference_id'=>54,'tag_id'=>8,'status'=>1,
                                                        'tag'=>new TagEntity(array('id'=>8,'name'=>'pizza')))) );
    $ref->tagLinks->push( new ReferenceToTagEntity(array('reference_id'=>54,'tag_id'=>98,'status'=>1,
                                                        'tag'=>new TagEntity(array('id'=>98,'name'=>'food')))) );
    $ref->tags = new EntityCollection("BankStats\Entities\TagEntity",$ref->tagLinks->pluck('tag'));
    
    #render("Links :". implode(',',$ref->tagLinks->pluck('tag')) );
  foreach($ref->tagLinks as $link){
    render($link->tag->id."-".$link->tag->name ."-".$link->status);
  }
    #render("Tags :". implode(',',$ref->tags->getManyBy('status',1)->pluck('id')) );
    $ref->updateTags($tags);
  render("--");
  #print_r($ref->tagLinks); 
   # render("Links :". implode(',',$ref->tagLinks->pluck('tag')->pluck('name')) );
    #render("Tags :". implode(',',$ref->tags->getManyBy('status',1)->pluck('id')) );
     foreach($ref->tagLinks as $link){
    render($link->tag->id."-".$link->tag->name ."-".$link->status);
  }
  render("--");
  
   render('keep: fuel,coffee,food,eating-out. delete : pizza,bills');
    
    exit;
    $repoProvider = getRepoProvider();
    
    $tagRepo = $repoProvider->get("BankStats\Repositories\TagRepository");
    $referenceRepo = $repoProvider->get("BankStats\Repositories\ReferenceRepository");
    $refToTagRepo = $repoProvider->get("BankStats\Repositories\ReferenceToTagRepository");
    $transactionRepo = $repoProvider->get("BankStats\Repositories\TransactionRepository");

    #$refToTagRepo->save($ref2tag);exit;

    $rows = $referenceRepo->with('tagLinks')->with('tags')->getMany();
    var_dump($rows->count());
    $first = $rows->get(0);
    var_dump($first->tags->count());
    var_dump($first->tagLinks->count());

    /*
    $rows = $tagRepo->getCount();
    var_dump($rows);
    $rows = $refToTagRepo->getCount();
    var_dump($rows);
    $rows = $transactionRepo->getCount();
    var_dump($rows);
    */

}
function debugInputCSV(){
    $data = array(
  'starting_line'=>0,
  'headings_to_lowercase'=>false,
  'heading_spaces_to_underscore'=>false,
  'file_adapter'=>new Local(__DIR__.'/data/'),
  'primary_key'=>'id',
);
$config = new Config($data);
$ds = new CSVDataSource($config);
$ds->setLocation('sample1');

}