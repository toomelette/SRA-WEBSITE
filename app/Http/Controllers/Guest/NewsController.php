<?php

namespace App\Http\Controllers\Guest;
use App\Http\Controllers\Controller;

use App\Core\Services\Guest\NewsService;

class NewsController extends Controller{
    


	protected $news;



    public function __construct(NewsService $news){

        $this->news = $news;

    }




    public function viewFile(){

    	return $this->news->viewFile();
    
    }




    public function viewImg(){

    	return $this->news->viewImg();
    
    }



    
}
