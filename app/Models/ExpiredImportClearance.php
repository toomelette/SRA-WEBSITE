<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class ExpiredImportClearance extends Model{



    use Sortable;

    protected $table = 'expired_import_clearances';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;




    protected $attributes = [

        'slug' => '',
        'expired_import_clearance_id' => '',
        'expired_import_clearance_cat_id' => '',
        'title' => '',
        'year' => null,
        'file_location' => '',
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];
    
    


    public function expiredImportClearanceCategory() {
        return $this->belongsTo('App\Models\ExpiredImportClearanceCategory','expired_import_clearance_cat_id','expired_import_clearance_cat_id');
    }


    
}
