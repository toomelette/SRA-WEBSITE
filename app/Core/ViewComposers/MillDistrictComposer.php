<?php

namespace App\Core\ViewComposers;


use View;
use App\Core\Interfaces\MillDistrictInterface;



class MillDistrictComposer{
   


	protected $mill_district_repo;




	public function __construct(MillDistrictInterface $mill_district_repo){

		$this->mill_district_repo = $mill_district_repo;

	}





    public function compose($view){

        $mill_districts = $this->mill_district_repo->getAll();
        
    	$view->with('global_mill_districts_all', $mill_districts);

    }






}