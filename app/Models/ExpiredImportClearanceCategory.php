<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpiredImportClearanceCategory extends Model{


    protected $table = 'expired_import_clearance_categories';
    
	public $timestamps = false;



    protected $attributes = [

        'seq_no' => 0,
        'expired_import_clearance_cat_id' => '',
        'name' => '',

    ];
    
    


    public function expiredImportClearance() {
        return $this->hasMany('App\Models\ExpiredImportClearance','expired_import_clearance_cat_id','expired_import_clearance_cat_id');
    }


    
}
