<?php

namespace App\Http\Controllers;

use App\Core\Services\AnnouncementService;
use App\Http\Requests\Announcement\AnnouncementFormRequest;
use App\Http\Requests\Announcement\AnnouncementFilterRequest;

class AnnouncementController extends Controller{


	 protected $announcement;



    public function __construct(AnnouncementService $announcement){

        $this->announcement = $announcement;

    }


    
    public function index(AnnouncementFilterRequest $request){
        
        return $this->announcement->fetch($request);

    }

    

    public function create(){
        
        return view('dashboard.announcement.create');

    }

   

    public function store(AnnouncementFormRequest $request){
        
        return $this->announcement->store($request);

    }
 



    public function viewFile($slug){
        
        return $this->announcement->viewFile($slug);

    }
 



    public function show($slug){
        
        return $this->announcement->show($slug);

    }
 



    public function edit($slug){
        
        return $this->announcement->edit($slug);

    }




    public function update(AnnouncementFormRequest $request, $slug){
        
        return $this->announcement->update($request, $slug);

    }

    


    public function destroy($slug){
        
        return $this->announcement->destroy($slug);

    }

    


}
