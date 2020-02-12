<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlantersDirectoryCategory extends Model{



    protected $table = 'planters_directory_categories';
    
	public $timestamps = false;



    protected $attributes = [

        'seq_no' => 0,
        'planters_dir_cat_id' => '',
        'name' => '',

    ];
    
    


    public function plantersDirectory() {
        return $this->hasMany('App\Models\PlantersDirectory','planters_dir_cat_id','planters_dir_cat_id');
    }
    
    

}
