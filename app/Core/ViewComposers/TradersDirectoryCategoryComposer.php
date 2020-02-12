<?php

namespace App\Core\ViewComposers;


use View;
use App\Core\Interfaces\TradersDirectoryCategoryInterface;



class TradersDirectoryCategoryComposer{
   


	protected $traders_dir_cat_repo;




	public function __construct(TradersDirectoryCategoryInterface $traders_dir_cat_repo){

		$this->traders_dir_cat_repo = $traders_dir_cat_repo;

	}





    public function compose($view){

        $traders_dir_cats = $this->traders_dir_cat_repo->getAll();
        
    	$view->with('global_traders_directory_categories_all', $traders_dir_cats);

    }






}