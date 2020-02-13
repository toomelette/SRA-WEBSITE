<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\IndustryStatisticsCategoryInterface;


use App\Models\IndustryStatisticsCategory;


class IndustryStatisticsCategoryRepository extends BaseRepository implements IndustryStatisticsCategoryInterface {
	



    protected $industry_statistics_category;




	public function __construct(IndustryStatisticsCategory $industry_statistics_category){

        $this->industry_statistics_category = $industry_statistics_category;
        parent::__construct();

    }





    public function getAll(){

        $industry_statistics_categories = $this->cache->remember('industry_statistics_categories:getAll', 240, function(){
            return $this->industry_statistics_category->select('industry_statistics_category_id','name')
                                                      ->orderBy('seq_no', 'asc')->get();
        });
        
        return $industry_statistics_categories;

    }





}