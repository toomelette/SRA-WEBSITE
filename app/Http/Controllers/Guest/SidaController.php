<?php

namespace App\Http\Controllers\Guest;
use App\Http\Controllers\Controller;

use App\Http\Requests\SIDAProgram\GuestSidaProgramFilterRequest;
use App\Http\Requests\SIDAGuideline\GuestSidaGuidelineFilterRequest;
use App\Http\Requests\SIDALaw\GuestSidaLawFilterRequest;
use App\Http\Requests\SIDAFundUtilization\GuestSidaFUFilterRequest;
use App\Core\Services\Guest\SidaService;


class SidaController extends Controller{
    

    protected $sida;


    public function __construct(SidaService $sida){
        $this->sida = $sida;
    }
   

    public function sidaUpdates(GuestSidaProgramFilterRequest $request){
        return $this->sida->fetchSidaUpdates($request);
    }
   

    public function viewSidaProgramDoc($slug){
        return $this->sida->viewSidaProgramDoc($slug);
    }
   

    public function sidaGuidelines(GuestSidaGuidelineFilterRequest $request){
        return $this->sida->fetchSidaGuidelines($request);
    }
   

    public function viewSidaGuidelineDoc($slug){
        return $this->sida->viewSidaGuidelineDoc($slug);
    }
   

    public function sidaLaws(GuestSidaLawFilterRequest $request){
        return $this->sida->fetchSidaLaws($request);
    }
   

    public function viewSidaLawDoc($slug){
        return $this->sida->viewSidaLawDoc($slug);
    }
   

    public function sidaFU(GuestSidaFUFilterRequest $request){
        return $this->sida->fetchSidaFU($request);
    }
   

    public function viewSidaFUDoc($slug){
        return $this->sida->viewSidaFUDoc($slug);
    }



}
