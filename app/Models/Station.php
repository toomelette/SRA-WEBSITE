<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Station extends Model{


    protected $table = 'stations';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;




    protected $attributes = [

        'slug' => '',
        'station_id' => '',
        'name' => '',
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];




    public function official() {
        return $this->hasMany('App\Models\Official','station_id','station_id');
    }




}
