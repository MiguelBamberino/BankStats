<?php

include __DIR__ ."/../vendor/autoload.php";


use PPCore\Adapters\DataSources\CSVDataSource;
use PPCore\Collections\Config;
use PPCore\RepositoryProvider;
use FileAdapter\Adapters\Local;

use BankStats\Entities\TagEntity;
use BankStats\Entities\ReferenceEntity;
use BankStats\Entities\ReferenceToTagEntity;
use BankStats\Entities\TransactionEntity;
use BankStats\Helpers\RepoEnum;

manageReferences();
exit;


#$rows = $ds->getMany();
function manageReferences(){
  $rp = getRepoProvider(); 
  $referenceRepo = $rp->get(RepoEnum::Reference);
  // pull out all known references
  $rows = $referenceRepo->with('tagLinks')->with('tags')->getMany();
  renderReferenceList($rows);
  
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
    render("[b] back | [x] edit tags");
    render("");
    $action = readline("action:");
    if(is_numeric($action)){
        
    }else{
        
    }
    render($action);
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
function debug(){
   
    $tag = new TagEntity(array('name'=>'fuel'));
    $ref = new ReferenceEntity(array('who'=>'teso','name'=>'Tesco LTD'));
    $ref2tag = new ReferenceToTagEntity(array('reference_id'=>1,'tag_id'=>3,));
    $trans = new TransactionEntity(array('reference_id'=>1,'amount'=>5.4,'date'=>'2018-09-02 00:00:00'));
 
    
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