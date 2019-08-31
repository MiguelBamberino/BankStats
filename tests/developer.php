<?php

include __DIR__ ."/../vendor/autoload.php";


use PPCore\Adapters\DataSources\CSVDataSource;
use PPCore\Collections\Config;
use PPCore\RepositoryProvider;
use FileAdapter\Adapters\Local;

use BankStats\Entities\TagEntity;
use BankStats\Entities\ReferenceEntity;
use BankStats\Entities\TransactionEntity;


$tag = new TagEntity(array('name'=>'fuel'));
$ref = new ReferenceEntity(array('who'=>'asda','name'=>'fuel'));
$trans = new TransactionEntity(array('reference_id'=>1,'amount'=>5.4,'date'=>'2018-09-02 00:00:00'));

$data = array(
  'starting_line'=>0,
  'headings_to_lowercase'=>false,
  'heading_spaces_to_underscore'=>false,
  'file_adapter'=>new Local(__DIR__.'/../data/'),
  'primary_key'=>'id',
);
$config = new Config($data);
$ds = new CSVDataSource($config);

$repoProvider = new RepositoryProvider('CSVDataSource',$config);
$tagRepo = $repoProvider->get("BankStats\Repositories\TagRepository");
$referenceRepo = $repoProvider->get("BankStats\Repositories\ReferenceRepository");
$transactionRepo = $repoProvider->get("BankStats\Repositories\TransactionRepository");

$rows = $tagRepo->getCount();
var_dump($rows);
$rows = $referenceRepo->getCount();
var_dump($rows);
$rows = $transactionRepo->getCount();
var_dump($rows);


exit;

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

#$rows = $ds->getMany();
