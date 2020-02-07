<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Official extends Model{



	use Sortable;

    protected $table = 'officials';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;

    public $sortable = ['fullname', 'position', 'email', 'contact_no'];




    protected $attributes = [

        'slug' => '',
        'official_id' => '',
        'office_id' => '',
        'station_id' => '',
        'file_location' => '',
        'fullname' => '',
        'position' => '',
        'email' => '',
        'contact_no' => '',
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];




    public function office() {
        return $this->belongsTo('App\Models\Office','office_id','office_id');
    }



    public function station() {
        return $this->belongsTo('App\Models\Station','station_id','station_id');
    }



    
}
