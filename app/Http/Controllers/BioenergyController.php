<?php

namespace App\Http\Controllers;

use App\Core\Services\BioenergyService;
use App\Http\Requests\Bioenergy\BioenergyFormRequest;
use App\Http\Requests\Bioenergy\BioenergyFilterRequest;


class BioenergyController extends Controller{


	protected $bioenergy;



    public function __construct(BioenergyService $bioenergy){

        $this->bioenergy = $bioenergy;

    }


    
    public function index(BioenergyFilterRequest $request){
        
        return $this->bioenergy->fetch($request);

    }

    

    public function create(){
        
        return view('dashboard.bioenergy.create');

    }

   

    public function store(BioenergyFormRequest $request){
        
        return $this->bioenergy->store($request);

    }
 



    public function viewFile($slug){
        
        return $this->bioenergy->viewFile($slug);

    }
 



    public function edit($slug){
        
        return $this->bioenergy->edit($slug);

    }




    public function update(BioenergyFormRequest $request, $slug){
        
        return $this->bioenergy->update($request, $slug);

    }

    


    public function destroy($slug){
    	
        return $this->bioenergy->destroy($slug);

    }


    
}
