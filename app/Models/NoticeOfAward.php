<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class NoticeOfAward extends Model{



    use Sortable;

    protected $table = 'notice_of_award';

    protected $dates = ['date', 'created_at', 'updated_at'];
    
	public $timestamps = false;




    protected $attributes = [

        'slug' => '',
        'notice_of_award_id' => '',
        'description' => '',
        'station' => true,
        'date' => null,
        'file_location_noa' => '',
        'file_location_bacreso' => '',
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];



}
