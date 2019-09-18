<?php 

namespace BankStats\Services;

use PPCore\Services\BaseService;
use PPCore\RepositoryProvider;
use PPCore\UtilityProvider;

use BankStats\Helpers\RepoEnum;

class ReferencesService extends BaseService{
  
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
      return $this->reference_repo->keyByID()->with('tagLinks')->with('tags')->getMany();
    }
}