<?php

namespace App\Http\Controllers\Guest;
use App\Http\Controllers\Controller;

use App\Http\Requests\InvitationToBid\GuestITBFilterRequest;
use App\Http\Requests\SupplementalBid\GuestSuppBidFilterRequest;
use App\Http\Requests\NoticeOfAward\GuestNOAFilterRequest;
use App\Http\Requests\NoticeToProceed\GuestNTPFilterRequest;
use App\Http\Requests\MinutesOfTheBid\GuestMOBFilterRequest;
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
   

    public function suppBid(GuestSuppBidFilterRequest $request){
        return $this->bid->fetchSuppBid($request);
    }
   

    public function viewSuppBid($slug){
        return $this->bid->viewSuppBid($slug);
    }
   

    public function NOA(GuestNOAFilterRequest $request){
        return $this->bid->fetchNOA($request);
    }
   

    public function viewNOA($slug){
        return $this->bid->viewNOA($slug);
    }
   

    public function viewBacReso($slug){
        return $this->bid->viewBacReso($slug);
    }
   

    public function NTP(GuestNTPFilterRequest $request){
        return $this->bid->fetchNTP($request);
    }
   

    public function viewNTP($slug){
        return $this->bid->viewNTP($slug);
    }
   

    public function viewPO($slug){
        return $this->bid->viewPO($slug);
    }
   

    public function philgepsPosting(){
        return view('guest.bid.philgeps_posting');
    }
   

    public function MOB(GuestMOBFilterRequest $request){
        return $this->bid->fetchMOB($request);
    }
   

    public function viewMOB($slug){
        return $this->bid->viewMOB($slug);
    }



}
