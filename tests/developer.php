<?php

include __DIR__ ."/../vendor/autoload.php";


use PPCore\Adapters\DataSources\CSVDataSource;
use PPCore\Collections\Config;
use FileAdapter\Adapters\Local;

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

$rows = $ds->getMany();

var_dump($rows);