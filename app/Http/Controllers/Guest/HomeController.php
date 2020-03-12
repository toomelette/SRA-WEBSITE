<?php

namespace App\Http\Controllers\Guest;
use App\Http\Controllers\Controller;

use App\Core\Services\Guest\HomeService;

class HomeController extends Controller{
    



	protected $home;




    public function __construct(HomeService $home){

        $this->home = $home;

    }





    public function index(){

    	return $this->home->contents();

    }



    
}
