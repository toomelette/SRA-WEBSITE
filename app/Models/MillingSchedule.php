<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class MillingSchedule extends Model{



    use Sortable;

    protected $table = 'milling_schedules';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;




    protected $attributes = [

        'slug' => '',
        'milling_schedule_id' => '',
        'title' => '',
        'file_location' => '',
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];


    
}
