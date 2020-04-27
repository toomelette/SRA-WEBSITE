<?php

namespace App\Http\Controllers\Guest;
use App\Http\Controllers\Controller;

use App\Http\Requests\Policy\GuestSugarOrderFilterRequest;
use App\Http\Requests\Policy\GuestCircularLetterFilterRequest;
use App\Http\Requests\Policy\GuestMemoOrderFilterRequest;
use App\Http\Requests\Policy\GuestMemoCirFilterRequest;
use App\Http\Requests\Policy\GuestMolassesOrderFilterRequest;
use App\Http\Requests\Policy\GuestMuscovadoOrderFilterRequest;
use App\Http\Requests\Policy\GuestGAOrderFilterRequest;
use App\Http\Requests\Policy\GuestSugarLawFilterRequest;
use App\Http\Requests\Policy\GuestBioenergyFilterRequest;
use App\Http\Requests\Policy\GuestAseanFilterRequest;
use App\Core\Services\Guest\PoliciesService;


class PoliciesController extends Controller{
    

    protected $policies;


    public function __construct(PoliciesService $policies){
        $this->policies = $policies;
    }
   

    public function sugarOrder(GuestSugarOrderFilterRequest $request){
        return $this->policies->fetchSugarOrder($request);
    }
   

    public function circularLetter(GuestCircularLetterFilterRequest $request){
        return $this->policies->fetchCircularLetter($request);
    }
   

    public function memoOrder(GuestMemoOrderFilterRequest $request){
        return $this->policies->fetchMemoOrder($request);
    }
   

    public function memoCir(GuestMemoCirFilterRequest $request){
        return $this->policies->fetchMemoCir($request);
    }

   
    public function molassesOrder(GuestMolassesOrderFilterRequest $request){
        return $this->policies->fetchMolassesOrder($request);
    }

   
    public function muscovadoOrder(GuestMuscovadoOrderFilterRequest $request){
        return $this->policies->fetchMuscovadoOrder($request);
    }

   
    public function GAOrder(GuestGAOrderFilterRequest $request){
        return $this->policies->fetchGAOrder($request);
    }

   
    public function sugarLaw(GuestSugarLawFilterRequest $request){
        return $this->policies->fetchSugarLaw($request);
    }


    public function bioenergy(GuestBioenergyFilterRequest $request){
        return $this->policies->fetchBioenergy($request);
    }


    public function asean(GuestAseanFilterRequest $request){
        return $this->policies->fetchAsean($request);
    }
   

    public function viewPolicyDoc($slug){
        return $this->policies->viewPolicyDoc($slug);
    }


}
