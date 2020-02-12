<?php

namespace App\Http\Controllers;

use App\Core\Services\EventService;
use App\Http\Requests\Event\EventFormRequest;
use App\Http\Requests\Event\EventFilterRequest;

class EventController extends Controller{


	protected $event;



    public function __construct(EventService $event){

        $this->event = $event;

    }


    
    public function index(EventFilterRequest $request){
        
        return $this->event->fetch($request);

    }

    

    public function create(){
        
        return view('dashboard.event.create');

    }

   

    public function store(EventFormRequest $request){
        
        return $this->event->store($request);

    }
 



    public function edit($slug){
        
        return $this->event->edit($slug);

    }
 



    public function viewFile($slug){
        
        return $this->event->viewFile($slug);

    }




    public function update(EventFormRequest $request, $slug){
        
        return $this->event->update($request, $slug);

    }

    


    public function destroy($slug){
        
        return $this->event->destroy($slug);

    }



    
}
