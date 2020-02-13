<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PolicyCategory extends Model{


    protected $table = 'policy_categories';
    
	public $timestamps = false;



    protected $attributes = [

        'seq_no' => 0,
        'policy_category_id' => '',
        'name' => '',

    ];
    
    


    public function policy() {
        return $this->hasMany('App\Models\Policy','policy_category_id','policy_category_id');
    }
   


}
