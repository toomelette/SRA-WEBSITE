<?php
 
namespace App\Core\Services\Guest;


use App\Core\BaseClasses\BaseService;



class HomeService extends BaseService{





    public function contents(){

        return view('guest.home.index');

    }








}