<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Administrator extends Model{


	use Sortable;

    protected $table = 'administrators';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;

    public $sortable = ['fullname', 'date_scope'];



    protected $attributes = [

        'slug' => '',
        'administrator_id' => '',
        'fullname' => '',
        'date_scope' => '',
        'file_location' => '',
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];



    
}
