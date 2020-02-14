<?php

namespace App\Http\Controllers;


use App\Core\Services\CropEstimateService;
use App\Http\Requests\CropEstimate\CropEstimateFormRequest;
use App\Http\Requests\CropEstimate\CropEstimateFilterRequest;


class CropEstimateController extends Controller{


	protected $crop_estimate;



    public function __construct(CropEstimateService $crop_estimate){

        $this->crop_estimate = $crop_estimate;

    }


    
    public function index(CropEstimateFilterRequest $request){
        
        return $this->crop_estimate->fetch($request);

    }

    

    public function create(){
        
        return view('dashboard.crop_estimate.create');

    }

   

    public function store(CropEstimateFormRequest $request){
        
        return $this->crop_estimate->store($request);

    }
 



    public function viewFile($slug){
        
        return $this->crop_estimate->viewFile($slug);

    }
 



    public function edit($slug){
        
        return $this->crop_estimate->edit($slug);

    }




    public function update(CropEstimateFormRequest $request, $slug){
        
        return $this->crop_estimate->update($request, $slug);

    }

    


    public function destroy($slug){
    	
        return $this->crop_estimate->destroy($slug);

    }

    

    
}
