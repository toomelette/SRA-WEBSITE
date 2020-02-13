<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\PolicyCategoryInterface;


use App\Models\PolicyCategory;


class PolicyCategoryRepository extends BaseRepository implements PolicyCategoryInterface {
	



    protected $policy_category;




	public function __construct(PolicyCategory $policy_category){

        $this->policy_category = $policy_category;
        parent::__construct();

    }





    public function getAll(){

        $policy_categories = $this->cache->remember('policy_categories:getAll', 240, function(){
            return $this->policy_category->select('policy_category_id','name')
                                          ->orderBy('seq_no', 'asc')->get();
        });
        
        return $policy_categories;

    }





}