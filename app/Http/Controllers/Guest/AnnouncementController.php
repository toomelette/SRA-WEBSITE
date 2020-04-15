<?php

namespace App\Http\Controllers\Guest;
use App\Http\Controllers\Controller;
use App\Core\Services\Guest\AnnouncementService;
use Illuminate\Http\Request;

class AnnouncementController extends Controller{
    

	protected $announcement;


    public function __construct(AnnouncementService $announcement){
        $this->announcement = $announcement;
    }


    public function index(Request $request){
        return $this->announcement->list($request);
    }


    public function details($slug){
        return $this->announcement->details($slug);
    }


    public function viewFile($slug){
    	return $this->announcement->viewFile($slug);
    }


    
}
