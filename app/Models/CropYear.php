<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CropYear extends Model{



    protected $table = 'crop_years';
    
	public $timestamps = false;



    protected $attributes = [

        'crop_year_id' => '',
        'name' => '',

    ];
    
    


    public function industryStatistic() {
        return $this->hasMany('App\Models\IndustryStatistic','crop_year_id','crop_year_id');
    }
    

}
