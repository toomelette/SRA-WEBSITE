<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Province extends Model{


    use Sortable;

    protected $table = 'provinces';
    
	public $timestamps = false;



    protected $attributes = [

    	'slug' => '',
        'province_id' => '',
        'name' => '',
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];
    
    


    public function millDistrict() {
        return $this->hasMany('App\Models\MillDistrict','province_id','province_id');
    }


    
}
