<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class SIDAGuideline extends Model{



	use Sortable;

    protected $table = 'sida_guidelines';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;

    public $sortable = ['title', 'year', 'description'];



    protected $attributes = [

        'slug' => '',
        'sida_guideline_id' => '',
        'title' => '',
        'year' => null,
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
