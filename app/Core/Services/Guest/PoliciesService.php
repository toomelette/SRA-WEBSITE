<?php
 
namespace App\Core\Services\Guest;
use App\Core\BaseClasses\BaseService;

use App\Core\Interfaces\PolicyInterface;
use File;

class PoliciesService extends BaseService{


    protected $policy_repo;


    public function __construct(PolicyInterface $policy_repo){
        $this->policy_repo = $policy_repo;
        parent::__construct();
    }


    public function fetchSugarOrder($request){
        $sugar_orders = $this->policy_repo->guestFetchByCatId('PC1001', $request);    
        return view('guest.policies.sugar_order')->with('sugar_orders', $sugar_orders);
    }


    public function viewSugarOrderDoc($slug){
        $sugar_order = $this->policy_repo->findBySlug($slug);
        if(!empty($sugar_order->file_location)){
            return $this->view_file('/'. $sugar_order->file_location);
        }
        return ''; 
    }


    public function fetchCircularLetter($request){
        $circular_letters = $this->policy_repo->guestFetchByCatId('PC1002', $request);    
        return view('guest.policies.circular_letter')->with('circular_letters', $circular_letters);
    }


    public function viewCircularLetterDoc($slug){
        $circular_letter = $this->policy_repo->findBySlug($slug);
        if(!empty($circular_letter->file_location)){
            return $this->view_file('/'. $circular_letter->file_location);
        }
        return ''; 
    }


    public function fetchMemoOrder($request){
        $memo_orders = $this->policy_repo->guestFetchByCatId('PC1003', $request);    
        return view('guest.policies.memo_order')->with('memo_orders', $memo_orders);
    }


    public function viewMemoOrderDoc($slug){
        $memo_order = $this->policy_repo->findBySlug($slug);
        if(!empty($memo_order->file_location)){
            return $this->view_file('/'. $memo_order->file_location);
        }
        return ''; 
    }


    public function fetchMemoCir($request){
        $memo_cirs = $this->policy_repo->guestFetchByCatId('PC1004', $request);    
        return view('guest.policies.memo_cir')->with('memo_cirs', $memo_cirs);
    }


    public function viewMemoCirDoc($slug){
        $memo_cir = $this->policy_repo->findBySlug($slug);
        if(!empty($memo_cir->file_location)){
            return $this->view_file('/'. $memo_cir->file_location);
        }
        return ''; 
    }




    // Utilities
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