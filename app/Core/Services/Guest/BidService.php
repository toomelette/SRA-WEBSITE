<?php
 
namespace App\Core\Services\Guest;
use App\Core\BaseClasses\BaseService;

use App\Core\Interfaces\InvitationToBidInterface;
use File;

class BidService extends BaseService{



    protected $itb_repo;



    public function __construct(InvitationToBidInterface $itb_repo){
        $this->itb_repo = $itb_repo;
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
        return ''; 
    }


    public function viewPBD($slug){
        $itb = $this->itb_repo->findBySlug($slug);
        if(!empty($itb->file_location_pbd)){
            return $this->view_file('/'. $itb->file_location_pbd);
        }
        return ''; 
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