<?php 

namespace BankStats\Services;

use PPCore\Services\BaseService;

use BankStats\Helpers\RepoEnum;

class ReferencesServices extends BaseService{
  
    protected $reference_repo;
    protected $tag_repo;
    /**
     * ReferencesServices constructor.
     * @param RepositoryProvider $repository_provider
     * @param UtilityProvider $utilityProvider
     * @throws
     */
    public function __construct(RepositoryProvider $repository_provider, UtilityProvider $utilityProvider) {
        parent::__construct($repository_provider,$utilityProvider);
        $this->reference_repo = $repository_provider->get(RepoEnum::Reference);
        $this->tag_repo = $repository_provider->get(RepoEnum::Tag);
    }
    
    public function getList(){
      
    }
}