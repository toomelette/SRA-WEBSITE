<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TradersDirectoryCategory extends Model{


    protected $table = 'traders_directory_categories';
    
	public $timestamps = false;



    protected $attributes = [

        'seq_no' => 0,
        'traders_dir_cat_id' => '',
        'name' => '',

    ];
    
    


    public function tradersDirectory() {
        return $this->hasMany('App\Models\TradersDirectory','traders_dir_cat_id','traders_dir_cat_id');
    }


    
}
