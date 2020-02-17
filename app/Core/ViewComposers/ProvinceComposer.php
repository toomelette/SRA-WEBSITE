<?php

namespace App\Core\ViewComposers;


use View;
use App\Core\Interfaces\ProvinceInterface;



class ProvinceComposer{
   


	protected $province_repo;




	public function __construct(ProvinceInterface $province_repo){

		$this->province_repo = $province_repo;

	}





    public function compose($view){

        $provinces = $this->province_repo->getAll();
        
    	$view->with('global_provinces_all', $provinces);

    }






}