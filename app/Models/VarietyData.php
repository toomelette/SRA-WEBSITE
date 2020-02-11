<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VarietyData extends Model{


    protected $table = 'variety_datas';
    
	public $timestamps = false;



    protected $attributes = [

        'variety_id' => '',
        'seq_no' => 0,
        'field' => '',
        'value' => '',

    ];




    /** RELATIONSHIPS **/
    public function variety() {
    	return $this->belongsTo('App\Models\Variety','variety_id','variety_id');
   	}

    

}
