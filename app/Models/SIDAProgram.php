<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class SIDAProgram extends Model{



	use Sortable;

    protected $table = 'sida_programs';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;

    public $sortable = ['title'];



    protected $attributes = [

        'slug' => '',
        'sida_program_id' => '',
        'province_id' => '',
        'mill_district_id' => '',
        'sida_program_cat_id' => '',
        'year' => null,
        'title' => '',
        'file_location' => '',
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];




    /** Relationships **/

    public function province() {
        return $this->belongsTo('App\Models\Province','province_id','province_id');
    }



    public function millDistrict() {
        return $this->belongsTo('App\Models\MillDistrict','mill_district_id','mill_district_id');
    }



    public function sidaProgramCategory() {
        return $this->belongsTo('App\Models\SIDAProgramCategory','sida_program_cat_id','sida_program_cat_id');
    }



    
}
