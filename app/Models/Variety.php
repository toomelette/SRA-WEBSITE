<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Variety extends Model{


    use Sortable;

    protected $table = 'varieties';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;

    public $sortable = ['name'];




    protected $attributes = [

        'slug' => '',
        'variety_id' => '',
        'name' => '',
        'file_location' => '',
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];



    /** RELATIONSHIPS **/
    public function varietyData() {
        return $this->hasMany('App\Models\VarietyData','variety_id','variety_id');
    }


    
}
