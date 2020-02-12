<?php

namespace App\Core\ViewComposers;


use View;
use App\Core\Interfaces\PlantersDirectoryCategoryInterface;



class PlantersDirectoryCategoryComposer{
   


	protected $planters_dir_cat_repo;




	public function __construct(PlantersDirectoryCategoryInterface $planters_dir_cat_repo){

		$this->planters_dir_cat_repo = $planters_dir_cat_repo;

	}





    public function compose($view){

        $planters_dir_cats = $this->planters_dir_cat_repo->getAll();
        
    	$view->with('global_planters_directory_categories_all', $planters_dir_cats);

    }






}