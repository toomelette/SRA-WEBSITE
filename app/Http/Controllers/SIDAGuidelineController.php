<?php

namespace App\Http\Controllers;

use App\Core\Services\SIDAGuidelineService;
use App\Http\Requests\SIDAGuideline\SIDAGuidelineFormRequest;
use App\Http\Requests\SIDAGuideline\SIDAGuidelineFilterRequest;

class SIDAGuidelineController extends Controller{




	protected $sida_guideline;



    public function __construct(SIDAGuidelineService $sida_guideline){

        $this->sida_guideline = $sida_guideline;

    }


    
    public function index(SIDAGuidelineFilterRequest $request){
        
        return $this->sida_guideline->fetch($request);

    }

    

    public function create(){
        
        return view('dashboard.sida_guideline.create');

    }

   

    public function store(SIDAGuidelineFormRequest $request){
        
        return $this->sida_guideline->store($request);

    }
 



    public function viewFile($slug){
        
        return $this->sida_guideline->viewFile($slug);

    }
 



    public function edit($slug){
        
        return $this->sida_guideline->edit($slug);

    }




    public function update(SIDAGuidelineFormRequest $request, $slug){
        
        return $this->sida_guideline->update($request, $slug);

    }

    


    public function destroy($slug){
        
        return $this->sida_guideline->destroy($slug);

    }

    

    
}
