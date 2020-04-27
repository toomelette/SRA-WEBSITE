<?php

namespace App\Http\Controllers\Guest;
use App\Http\Controllers\Controller;

use App\Http\Requests\SIDAProgram\GuestSidaProgramFilterRequest;
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



}
