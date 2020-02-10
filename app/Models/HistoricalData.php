<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class HistoricalData extends Model{


	use Sortable;

    protected $table = 'historical_datas';

    protected $dates = ['date_to', 'date_from', 'created_at', 'updated_at'];
    
	public $timestamps = false;

    public $sortable = ['title', 'date_to', 'date_from'];



    protected $attributes = [

        'slug' => '',
        'historical_data_id' => '',
        'title' => '',
        'date_from' => '',
        'date_to' => '',
        'file_location' => '',
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];



    
}
