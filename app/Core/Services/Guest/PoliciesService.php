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


    public function fetchCircularLetter($request){
        $circular_letters = $this->policy_repo->guestFetchByCatId('PC1002', $request);    
        return view('guest.policies.circular_letter')->with('circular_letters', $circular_letters);
    }


    public function fetchMemoOrder($request){
        $memo_orders = $this->policy_repo->guestFetchByCatId('PC1003', $request);    
        return view('guest.policies.memo_order')->with('memo_orders', $memo_orders);
    }


    public function fetchMemoCir($request){
        $memo_cirs = $this->policy_repo->guestFetchByCatId('PC1004', $request);    
        return view('guest.policies.memo_cir')->with('memo_cirs', $memo_cirs);
    }


    public function fetchMolassesOrder($request){
        $molasses_orders = $this->policy_repo->guestFetchByCatId('PC1005', $request);    
        return view('guest.policies.molasses_order')->with('molasses_orders', $molasses_orders);
    }


    public function fetchMuscovadoOrder($request){
        $muscovado_orders = $this->policy_repo->guestFetchByCatId('PC1006', $request);    
        return view('guest.policies.muscovado_order')->with('muscovado_orders', $muscovado_orders);
    }


    public function fetchGAOrder($request){
        $ga_orders = $this->policy_repo->guestFetchByCatId('PC1007', $request);    
        return view('guest.policies.ga_order')->with('ga_orders', $ga_orders);
    }


    public function fetchSugarLaw($request){
        $sugar_laws = $this->policy_repo->guestFetchByCatId('PC1008', $request);    
        return view('guest.policies.sugar_law')->with('sugar_laws', $sugar_laws);
    }


    public function fetchBioenergy($request){
        $bioenergy_list = $this->policy_repo->guestFetchByCatId('PC1009', $request);    
        return view('guest.policies.bioenergy')->with('bioenergy_list', $bioenergy_list);
    }


    public function fetchAsean($request){
        $asean_list = $this->policy_repo->guestFetchByCatId('PC10010', $request);    
        return view('guest.policies.asean')->with('asean_list', $asean_list);
    }


    public function viewPolicyDoc($slug){

        $policy = $this->policy_repo->findBySlug($slug);

        if (!empty($policy->file_location)) {
            $path = $this->__static->archive_dir() .'/'. $policy->file_location;
            if (!File::exists($path)){ return abort(404); }
            $file = File::get($path);
            $type = File::mimeType($path);
            $response = response()->make($file, 200);
            $response->header("Content-Type", $type);
            return $response;
        }

    }



}