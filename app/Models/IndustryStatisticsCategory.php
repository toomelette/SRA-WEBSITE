<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndustryStatisticsCategory extends Model{


    protected $table = 'industry_statistics_categories';
    
	public $timestamps = false;



    protected $attributes = [

        'seq_no' => 0,
        'industry_statistics_category_id' => '',
        'name' => '',

    ];
    
    


    public function industryStatistic() {
        return $this->hasMany('App\Models\IndustryStatistic','industry_statistics_category_id','industry_statistics_category_id');
    }


    
}
