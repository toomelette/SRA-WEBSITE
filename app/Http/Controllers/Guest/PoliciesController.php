<?php

namespace App\Http\Controllers\Guest;
use App\Http\Controllers\Controller;

use App\Http\Requests\Policy\GuestSugarOrderFilterRequest;
use App\Http\Requests\Policy\GuestCircularLetterFilterRequest;
use App\Http\Requests\Policy\GuestMemoOrderFilterRequest;
use App\Http\Requests\Policy\GuestMemoCirFilterRequest;

use App\Core\Services\Guest\PoliciesService;


class PoliciesController extends Controller{
    

    protected $policies;


    public function __construct(PoliciesService $policies){
        $this->policies = $policies;
    }
   

    public function sugarOrder(GuestSugarOrderFilterRequest $request){
        return $this->policies->fetchSugarOrder($request);
    }
   

    public function viewSugarOrderDoc($slug){
        return $this->policies->viewSugarOrderDoc($slug);
    }
   

    public function circularLetter(GuestCircularLetterFilterRequest $request){
        return $this->policies->fetchCircularLetter($request);
    }
   

    public function viewCircularLetterDoc($slug){
        return $this->policies->viewCircularLetterDoc($slug);
    }
   

    public function memoOrder(GuestMemoOrderFilterRequest $request){
        return $this->policies->fetchMemoOrder($request);
    }
   

    public function viewMemoOrderDoc($slug){
        return $this->policies->viewMemoOrderDoc($slug);
    }
   

    public function memoCir(GuestMemoCirFilterRequest $request){
        return $this->policies->fetchMemoCir($request);
    }
   

    public function viewMemoCirDoc($slug){
        return $this->policies->viewMemoCirDoc($slug);
    }




}
