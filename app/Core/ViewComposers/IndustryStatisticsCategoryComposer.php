<?php

namespace App\Core\ViewComposers;


use View;
use App\Core\Interfaces\IndustryStatisticsCategoryInterface;



class IndustryStatisticsCategoryComposer{
   


	protected $industry_statistics_category_repo;




	public function __construct(IndustryStatisticsCategoryInterface $industry_statistics_category_repo){

		$this->industry_statistics_category_repo = $industry_statistics_category_repo;

	}





    public function compose($view){

        $industry_statistics_categories = $this->industry_statistics_category_repo->getAll();
        
    	$view->with('global_industry_statistics_categories_all', $industry_statistics_categories);

    }






}