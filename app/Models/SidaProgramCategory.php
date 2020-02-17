<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class SidaProgramCategory extends Model{



	use Sortable;

    protected $table = 'sida_program_categories';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;

    public $sortable = ['name'];



    protected $attributes = [

        'slug' => '',
        'sida_program_cat_id' => '',
        'name' => '',
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];


    
}
