<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\ExpiredImportClearanceCategoryInterface;


use App\Models\ExpiredImportClearanceCategory;


class ExpiredImportClearanceCategoryRepository extends BaseRepository implements ExpiredImportClearanceCategoryInterface {
	



    protected $expired_import_clearance_category;




	public function __construct(ExpiredImportClearanceCategory $expired_import_clearance_category){

        $this->expired_import_clearance_category = $expired_import_clearance_category;
        parent::__construct();

    }





    public function getAll(){

        $expired_import_clearance_categories = $this->cache->remember('expired_import_clearance_categories:getAll', 240, function(){
            return $this->expired_import_clearance_category->select('expired_import_clearance_cat_id','name')
                                                      ->orderBy('seq_no', 'asc')->get();
        });
        
        return $expired_import_clearance_categories;

    }





}