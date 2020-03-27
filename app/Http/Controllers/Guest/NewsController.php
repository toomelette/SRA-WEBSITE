<?php

namespace App\Http\Controllers\Guest;
use App\Http\Controllers\Controller;
use App\Core\Services\Guest\NewsService;
use Illuminate\Http\Request;

class NewsController extends Controller{
    


	protected $news;



    public function __construct(NewsService $news){

        $this->news = $news;

    }




    public function index(Request $request){

        return $this->news->list($request);
    
    }




    public function details($slug){

        return $this->news->details($slug);
    
    }




    public function viewFile($slug){

    	return $this->news->viewFile($slug);
    
    }




    public function viewImg($slug){

    	return $this->news->viewImg($slug);
    
    }



    
}
