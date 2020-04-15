<?php

namespace App\Http\Controllers\Guest;
use App\Http\Controllers\Controller;
use App\Http\Requests\Variety\GuestVarietyFilterRequest;
use App\Http\Requests\Research\GuestResearchFilterRequest;
use App\Core\Services\Guest\AboutSugarcaneService;


class AboutSugarcaneController extends Controller{
    

    protected $about_sugarcane;


    public function __construct(AboutSugarcaneService $about_sugarcane){
        $this->about_sugarcane = $about_sugarcane;
    }
   

    public function varieties(GuestVarietyFilterRequest $request){
        return $this->about_sugarcane->fetchVarieties($request);
    }
   

    public function viewVarietyImg($slug){
        return $this->about_sugarcane->viewVarietyImg($slug);
    }
   

    public function researches(GuestResearchFilterRequest $request){
        return $this->about_sugarcane->fetchResearches($request);
    }
   

    public function researchDetails($slug){
        return $this->about_sugarcane->researchDetails($slug);
    }


}
