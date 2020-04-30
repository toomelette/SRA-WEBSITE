<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class AdminCorner extends Model{


	use Sortable;

    protected $table = 'admin_corner';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;

    public $sortable = ['title', 'content'];



    protected $attributes = [

        'slug' => '',
        'admin_corner_id' => '',
        'type' => 0,
        'title' => '',
        'content' => '',
        'img_location' => '',
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];



    
}
