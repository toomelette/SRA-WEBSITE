<?php

namespace App\Core\ViewComposers;


use View;
use App\Core\Interfaces\PolicyCategoryInterface;



class PolicyCategoryComposer{
   


	protected $policy_category_repo;




	public function __construct(PolicyCategoryInterface $policy_category_repo){

		$this->policy_category_repo = $policy_category_repo;

	}





    public function compose($view){

        $policy_categories = $this->policy_category_repo->getAll();
        
    	$view->with('global_policy_categories_all', $policy_categories);

    }






}