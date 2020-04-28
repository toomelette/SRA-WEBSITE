<?php

namespace App\Http\Controllers\Guest;
use App\Http\Controllers\Controller;

use App\Http\Requests\InvitationToBid\GuestITBFilterRequest;
use App\Core\Services\Guest\BidService;


class BidController extends Controller{
    

    protected $bid;


    public function __construct(BidService $bid){
        $this->bid = $bid;
    }
   

    public function ITB(GuestITBFilterRequest $request){
        return $this->bid->fetchITB($request);
    }
   

    public function viewITB($slug){
        return $this->bid->viewITB($slug);
    }
   

    public function viewPBD($slug){
        return $this->bid->viewPBD($slug);
    }



}
