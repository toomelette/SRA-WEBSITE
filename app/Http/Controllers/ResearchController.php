<?php

namespace App\Http\Controllers;

use App\Core\Services\ResearchService;
use App\Http\Requests\Research\ResearchFormRequest;
use App\Http\Requests\Research\ResearchFilterRequest;

class ResearchController extends Controller{


	protected $research;



    public function __construct(ResearchService $research){

        $this->research = $research;

    }


    
    public function index(ResearchFilterRequest $request){
        
        return $this->research->fetch($request);

    }

    

    public function create(){
        
        return view('dashboard.research.create');

    }

   

    public function store(ResearchFormRequest $request){
        
        return $this->research->store($request);

    }
 



    public function show($slug){
        
        return $this->research->show($slug);

    }
 



    public function edit($slug){
        
        return $this->research->edit($slug);

    }




    public function update(ResearchFormRequest $request, $slug){
        
        return $this->research->update($request, $slug);

    }

    


    public function destroy($slug){
        
        return $this->research->destroy($slug);

    }


    
}
