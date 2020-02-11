<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Research extends Model{


	use Sortable;

    protected $table = 'researches';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;

    public $sortable = ['title', 'content'];




    protected $attributes = [

        'slug' => '',
        'research_id' => '',
        'title' => '',
        'content' => '',
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];
    


    
}
