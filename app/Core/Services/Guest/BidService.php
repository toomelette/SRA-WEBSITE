<?php
 
namespace App\Core\Services\Guest;
use App\Core\BaseClasses\BaseService;

use App\Core\Interfaces\InvitationToBidInterface;
use App\Core\Interfaces\SupplementalBidInterface;
use App\Core\Interfaces\NoticeOfAwardInterface;
use App\Core\Interfaces\NoticeToProceedInterface;
use App\Core\Interfaces\MinutesOfTheBidInterface;
use File;

class BidService extends BaseService{



    protected $itb_repo;
    protected $supp_bid_repo;
    protected $noa_repo;
    protected $ntp_repo;
    protected $mob_repo;



    public function __construct(InvitationToBidInterface $itb_repo, SupplementalBidInterface $supp_bid_repo, NoticeOfAwardInterface $noa_repo, NoticeToProceedInterface $ntp_repo, MinutesOfTheBidInterface $mob_repo){
        $this->itb_repo = $itb_repo;
        $this->supp_bid_repo = $supp_bid_repo;
        $this->noa_repo = $noa_repo;
        $this->ntp_repo = $ntp_repo;
        $this->mob_repo = $mob_repo;
        parent::__construct();
    }



    public function fetchITB($request){
        $itb_list = $this->itb_repo->guestFetch($request);    
        return view('guest.bid.itb')->with('itb_list', $itb_list);
    }


    public function viewITB($slug){
        $itb = $this->itb_repo->findBySlug($slug);
        if(!empty($itb->file_location_itb)){
            return $this->view_file('/'. $itb->file_location_itb);
        }
        return abort(404);
    }


    public function viewPBD($slug){
        $itb = $this->itb_repo->findBySlug($slug);
        if(!empty($itb->file_location_pbd)){
            return $this->view_file('/'. $itb->file_location_pbd);
        }
        return abort(404);
    }



    public function fetchSuppBid($request){
        $supp_bid_list = $this->supp_bid_repo->guestFetch($request);    
        return view('guest.bid.supp_bid')->with('supp_bid_list', $supp_bid_list);
    }


    public function viewSuppBid($slug){
        $supp_bid = $this->supp_bid_repo->findBySlug($slug);
        if(!empty($supp_bid->file_location)){
            return $this->view_file('/'. $supp_bid->file_location);
        }
        return abort(404);
    }



    public function fetchNOA($request){
        $noa_list = $this->noa_repo->guestFetch($request);    
        return view('guest.bid.noa')->with('noa_list', $noa_list);
    }


    public function viewNOA($slug){
        $noa = $this->noa_repo->findBySlug($slug);
        if(!empty($noa->file_location_noa)){
            return $this->view_file('/'. $noa->file_location_noa);
        }
        return abort(404);
    }


    public function viewBacReso($slug){
        $noa = $this->noa_repo->findBySlug($slug);
        if(!empty($noa->file_location_bacreso)){
            return $this->view_file('/'. $noa->file_location_bacreso);
        }
        return abort(404); 
    }



    public function fetchNTP($request){
        $ntp_list = $this->ntp_repo->guestFetch($request);    
        return view('guest.bid.ntp')->with('ntp_list', $ntp_list);
    }


    public function viewNTP($slug){
        $ntp = $this->ntp_repo->findBySlug($slug);
        if(!empty($ntp->file_location_ntp)){
            return $this->view_file('/'. $ntp->file_location_ntp);
        }
        return abort(404);
    }


    public function viewPO($slug){
        $ntp = $this->ntp_repo->findBySlug($slug);
        if(!empty($ntp->file_location_po)){
            return $this->view_file('/'. $ntp->file_location_po);
        }
        return abort(404); 
    }



    public function fetchMOB($request){
        $mob_list = $this->mob_repo->guestFetch($request);    
        return view('guest.bid.mob')->with('mob_list', $mob_list);
    }


    public function viewMOB($slug){
        $mob = $this->mob_repo->findBySlug($slug);
        if(!empty($mob->file_location)){
            return $this->view_file('/'. $mob->file_location);
        }
        return abort(404);
    }





    // UTIL
    private function view_file($loc){
        $path = $this->__static->archive_dir() . $loc;
        if (!File::exists($path)){ return abort(404); }
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = response()->make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }




}