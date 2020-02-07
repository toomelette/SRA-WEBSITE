<?php

namespace App\Core\ViewComposers;


use View;
use App\Core\Interfaces\OfficeInterface;


class OfficeComposer{
   



	protected $office_repo;




	public function __construct(OfficeInterface $office_repo){

		$this->office_repo = $office_repo;

	}





    public function compose($view){

        $offices = $this->office_repo->getAll();
        
    	$view->with('global_offices_all', $offices);

    }






}