<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class TradersDirectory extends Model{



    use Sortable;

    protected $table = 'traders_directory';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;





    protected $attributes = [

        'slug' => '',
        'traders_dir_id' => '',
        'traders_dir_cat_id' => '',
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
    
    


    public function tradersDirectoryCategory() {
        return $this->belongsTo('App\Models\TradersDirectoryCategory','traders_dir_cat_id','traders_dir_cat_id');
    }






    
}
