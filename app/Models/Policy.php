<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Policy extends Model{


    use Sortable;

    protected $table = 'policies';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;




    protected $attributes = [

        'slug' => '',
        'policy_id' => '',
        'crop_year_id' => '',
        'policy_category_id' => '',
        'title' => '',
        'file_location' => '',
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];
    
    


    public function policyCategory() {
        return $this->belongsTo('App\Models\PolicyCategory','policy_category_id','policy_category_id');
    }
    
    


    public function cropYear() {
        return $this->belongsTo('App\Models\CropYear','crop_year_id','crop_year_id');
    }

    
}
