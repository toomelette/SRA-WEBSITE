<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class SIDAFundUtilization extends Model{



	use Sortable;

    protected $table = 'sida_fund_utilizations';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;

    public $sortable = ['title', 'year', 'description'];



    protected $attributes = [

        'slug' => '',
        'sida_fund_utilization_id' => '',
        'title' => '',
        'description' => '',
        'file_location' => '',
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];



}
