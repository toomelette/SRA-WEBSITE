<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class PlantersDirectory extends Model{



    use Sortable;

    protected $table = 'planters_directory';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;




    protected $attributes = [

        'slug' => '',
        'planters_dir_id' => '',
        'planters_dir_cat_id' => '',
        'title' => '',
        'description' => '',
        'file_location' => '',
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];
    
    


    public function plantersDirectoryCategory() {
        return $this->belongsTo('App\Models\PlantersDirectoryCategory','planters_dir_cat_id','planters_dir_cat_id');
    }



    
}
