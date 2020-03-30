<?php

namespace App\Http\Controllers\Guest;
use App\Http\Controllers\Controller;


class AboutUsController extends Controller{
   

    public function mandate(){
    	return view('guest.about_us.mandate');
    }
   

    public function services(){
    	return view('guest.about_us.services');
    }

    
}
