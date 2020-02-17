<?php

namespace App\Core\ViewComposers;


use View;
use App\Core\Interfaces\SIDAProgramCategoryInterface;



class SIDAProgramCategoryComposer{
   


	protected $sida_program_category_repo;




	public function __construct(SIDAProgramCategoryInterface $sida_program_category_repo){

		$this->sida_program_category_repo = $sida_program_category_repo;

	}





    public function compose($view){

        $sida_program_categories = $this->sida_program_category_repo->getAll();
        
    	$view->with('global_sida_program_categories_all', $sida_program_categories);

    }






}