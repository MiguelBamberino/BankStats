<?php

namespace BankStats\Repositories;

use PPCore\Repositories\RelationalRepository;

class TransactionRepository extends RelationalRepository{
  
    protected $location = 'BankStats/transactions';
    protected $defaultEntityClass = 'TransactionEntity';
  
}