<?php

namespace App\Http\Controllers;

use App\Core\Services\MillingScheduleService;
use App\Http\Requests\MillingSchedule\MillingScheduleFormRequest;
use App\Http\Requests\MillingSchedule\MillingScheduleFilterRequest;

class MillingScheduleController extends Controller{


	protected $milling_schedule;



    public function __construct(MillingScheduleService $milling_schedule){

        $this->milling_schedule = $milling_schedule;

    }


    
    public function index(MillingScheduleFilterRequest $request){
        
        return $this->milling_schedule->fetch($request);

    }

    

    public function create(){
        
        return view('dashboard.milling_schedule.create');

    }

   

    public function store(MillingScheduleFormRequest $request){
        
        return $this->milling_schedule->store($request);

    }
 



    public function viewFile($slug){
        
        return $this->milling_schedule->viewFile($slug);

    }
 



    public function edit($slug){
        
        return $this->milling_schedule->edit($slug);

    }




    public function update(MillingScheduleFormRequest $request, $slug){
        
        return $this->milling_schedule->update($request, $slug);

    }

    


    public function destroy($slug){
        
        return $this->milling_schedule->destroy($slug);

    }

    

}
