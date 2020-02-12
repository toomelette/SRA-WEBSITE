<?php

namespace App\Http\Controllers;

use App\Core\Services\PlantersDirectoryService;
use App\Http\Requests\PlantersDirectory\PlantersDirectoryFormRequest;
use App\Http\Requests\PlantersDirectory\PlantersDirectoryFilterRequest;

class PlantersDirectoryController extends Controller{


	protected $planters_directory;



    public function __construct(PlantersDirectoryService $planters_directory){

        $this->planters_directory = $planters_directory;

    }


    
    public function index(PlantersDirectoryFilterRequest $request){
        
        return $this->planters_directory->fetch($request);

    }

    

    public function create(){
        
        return view('dashboard.planters_directory.create');

    }

   

    public function store(PlantersDirectoryFormRequest $request){
        
        return $this->planters_directory->store($request);

    }
 



    public function viewFile($slug){
        
        return $this->planters_directory->viewFile($slug);

    }
 



    public function edit($slug){
        
        return $this->planters_directory->edit($slug);

    }




    public function update(PlantersDirectoryFormRequest $request, $slug){
        
        return $this->planters_directory->update($request, $slug);

    }

    


    public function destroy($slug){
        
        return $this->planters_directory->destroy($slug);

    }



    
}
