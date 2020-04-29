<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class MinutesOfTheBid extends Model{



    use Sortable;

    protected $table = 'minutes_of_the_bid';

    protected $dates = ['date', 'created_at', 'updated_at'];
    
	public $timestamps = false;




    protected $attributes = [

        'slug' => '',
        'motb_id' => '',
        'title' => '',
        'location' => '',
        'date' => null,
        'file_location' => '',
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];


    
}
