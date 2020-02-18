<?php

namespace App\Http\Controllers;

use App\Core\Services\SIDALawService;
use App\Http\Requests\SIDALaw\SIDALawFormRequest;
use App\Http\Requests\SIDALaw\SIDALawFilterRequest;

class SIDALawController extends Controller{




	protected $sida_law;



    public function __construct(SIDALawService $sida_law){

        $this->sida_law = $sida_law;

    }


    
    public function index(SIDALawFilterRequest $request){
        
        return $this->sida_law->fetch($request);

    }

    

    public function create(){
        
        return view('dashboard.sida_law.create');

    }

   

    public function store(SIDALawFormRequest $request){
        
        return $this->sida_law->store($request);

    }
 



    public function viewFile($slug){
        
        return $this->sida_law->viewFile($slug);

    }
 



    public function edit($slug){
        
        return $this->sida_law->edit($slug);

    }




    public function update(SIDALawFormRequest $request, $slug){
        
        return $this->sida_law->update($request, $slug);

    }

    


    public function destroy($slug){
        
        return $this->sida_law->destroy($slug);

    }




    
}
