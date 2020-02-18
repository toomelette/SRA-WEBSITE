<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class MillDistrict extends Model{


    use Sortable;

    protected $table = 'mill_districts';
    
	public $timestamps = false;



    protected $attributes = [

    	'slug' => '',
        'mill_district_id' => '',
        'province_id' => '',
        'name' => '',
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];





     /** Relationships **/

    public function sidaProgram() {
        return $this->hasMany('App\Models\SIDAProgram','mill_district_id','mill_district_id');
    }
    
    

    public function province() {
        return $this->belongsTo('App\Models\Province','province_id','province_id');
    }


    
}
