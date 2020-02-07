<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Office extends Model{


	use Sortable;

    protected $table = 'offices';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;

    public $sortable = ['seq_no', 'name'];




    protected $attributes = [

        'slug' => '',
        'office_id' => '',
        'seq_no' => 0,
        'name' => '',
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];
    
    


    public function official() {
        return $this->hasMany('App\Models\Official','office_id','office_id');
    }



    
}
