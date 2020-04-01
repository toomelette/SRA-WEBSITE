<?php

namespace App\Http\Controllers\Guest;
use App\Http\Controllers\Controller;

use App\Core\Services\Guest\AboutUsService;


class AboutUsController extends Controller{
    

	protected $about_us;


    public function __construct(AboutUsService $about_us){
        $this->about_us = $about_us;
    }
   

    public function mandate(){
    	return view('guest.about_us.mandate');
    }
   

    public function services(){
    	return view('guest.about_us.services');
    }
   

    public function viewServiceGuide($slug){
    	return $this->about_us->viewServiceGuide($slug);
    }
   

    public function viewServiceFees(){
        return $this->about_us->viewServiceFees();
    }
   

    public function charter(){
        return view('guest.about_us.charter');
    }
   

    public function viewCharterEO(){
        return $this->about_us->viewCharterEO();
    }
   

    public function orgChart(){
        return view('guest.about_us.org_chart');
    }
   

    public function viewOrgChartImg(){
        return $this->about_us->viewOrgChartImg();
    }
   

    public function viewOrgFunctionalStatements(){
        return $this->about_us->viewOrgFunctionalStatements();
    }
   

    public function corpObjectives(){
        return view('guest.about_us.corp_objectives');
    }
   

    public function history(){
        return view('guest.about_us.history');
    }


}
