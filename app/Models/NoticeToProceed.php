<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class NoticeToProceed extends Model{



    use Sortable;

    protected $table = 'notice_to_proceed';

    protected $dates = ['date', 'created_at', 'updated_at'];
    
	public $timestamps = false;




    protected $attributes = [

        'slug' => '',
        'notice_to_proceed_id' => '',
        'description' => '',
        'station' => true,
        'date' => null,
        'file_location_ntp' => '',
        'file_location_po' => '',
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];



    public function getStationAttribute($value){

        if ($value == 1) {
            return "SRA-QUEZON CITY";
        }else{
            return "SRA-BACOLOD CITY";
        }

    }



}
