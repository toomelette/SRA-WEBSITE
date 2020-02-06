<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class News extends Model{





    use Sortable;

    protected $table = 'news';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;

    public $sortable = ['title', 'content', 'updated_at'];





    protected $attributes = [

        'slug' => '',
        'type' => '',
        'file_location' => '',
        'url' => '',
        'news_id' => '',
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
