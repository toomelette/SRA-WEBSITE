<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class IndustryStatistic extends Model{



    use Sortable;

    protected $table = 'industry_statistics';

    protected $dates = ['cut_off_date', 'created_at', 'updated_at'];
    
	public $timestamps = false;




    protected $attributes = [

        'slug' => '',
        'industry_statistic_id' => '',
        'crop_year_id' => '',
        'industry_statistics_category_id' => '',
        'title' => '',
        'cut_off_date' => null,
        'file_location' => '',
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];
    
    


    public function industryStatisticsCategory() {
        return $this->belongsTo('App\Models\IndustryStatisticsCategory','industry_statistics_category_id','industry_statistics_category_id');
    }
    
    

    public function cropYear() {
        return $this->belongsTo('App\Models\CropYear','crop_year_id','crop_year_id');
    }


    
}
