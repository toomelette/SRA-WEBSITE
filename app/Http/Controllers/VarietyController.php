<?php

namespace App\Http\Controllers;

use App\Core\Services\VarietyService;
use App\Http\Requests\Variety\VarietyFormRequest;
use App\Http\Requests\Variety\VarietyFilterRequest;

class VarietyController extends Controller{


	protected $variety;



    public function __construct(VarietyService $variety){

        $this->variety = $variety;

    }


    
    public function index(VarietyFilterRequest $request){
        
        return $this->variety->fetch($request);

    }

    

    public function create(){
        
        return view('dashboard.variety.create');

    }

   

    public function store(VarietyFormRequest $request){
        
        return $this->variety->store($request);

    }
 



    public function viewImg($slug){
        
        return $this->variety->viewImg($slug);

    }
 



    public function show($slug){
        
        return $this->variety->show($slug);

    }
 



    public function edit($slug){
        
        return $this->variety->edit($slug);

    }




    public function update(VarietyFormRequest $request, $slug){
        
        return $this->variety->update($request, $slug);

    }

    


    public function destroy($slug){
    	
        return $this->variety->destroy($slug);

    }


    

    
}
