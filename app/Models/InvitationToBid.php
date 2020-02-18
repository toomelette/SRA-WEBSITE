<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class InvitationToBid extends Model{




    use Sortable;

    protected $table = 'invitations_to_bid';

    protected $dates = ['date', 'created_at', 'updated_at'];
    
	public $timestamps = false;




    protected $attributes = [

        'slug' => '',
        'invitation_to_bid_id' => '',
        'description' => '',
        'station' => true,
        'date' => null,
        'file_location_itb' => '',
        'file_location_pbd' => '',
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];



    
}
