<?php

namespace App\Core\ViewComposers;


use View;
use App\Core\Interfaces\ExpiredImportClearanceCategoryInterface;



class ExpiredImportClearanceCategoryComposer{
   


	protected $expired_import_clearance_category_repo;




	public function __construct(ExpiredImportClearanceCategoryInterface $expired_import_clearance_category_repo){

		$this->expired_import_clearance_category_repo = $expired_import_clearance_category_repo;

	}





    public function compose($view){

        $expired_import_clearance_categories = $this->expired_import_clearance_category_repo->getAll();
        
    	$view->with('global_expired_import_clearance_categories_all', $expired_import_clearance_categories);

    }






}