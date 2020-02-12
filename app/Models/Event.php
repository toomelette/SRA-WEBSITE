<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Event extends Model{



	use Sortable;

    protected $table = 'events';

    protected $dates = ['date_to', 'date_from', 'created_at', 'updated_at'];
    
	public $timestamps = false;

    public $sortable = ['title', 'date_to', 'date_from'];



    protected $attributes = [

        'slug' => '',
        'event_id' => '',
        'station_id' => '',
        'title' => '',
        'description' => '',
        'date_from' => null,
        'date_to' => null,
        'file_location' => '',
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];



    public function station() {
        return $this->belongsTo('App\Models\Station','station_id','station_id');
    }



    
}
