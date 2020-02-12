<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\PlantersDirectoryCategoryInterface;


use App\Models\PlantersDirectoryCategory;


class PlantersDirectoryCategoryRepository extends BaseRepository implements PlantersDirectoryCategoryInterface {
	



    protected $planters_dir_cat;




	public function __construct(PlantersDirectoryCategory $planters_dir_cat){

        $this->planters_dir_cat = $planters_dir_cat;
        parent::__construct();

    }





    public function getAll(){

        $planters_dir_cats = $this->cache->remember('planters_directory_categories:getAll', 240, function(){
            return $this->planters_dir_cat->select('planters_dir_cat_id','name')
                                          ->orderBy('seq_no', 'asc')->get();
        });
        
        return $planters_dir_cats;

    }





}