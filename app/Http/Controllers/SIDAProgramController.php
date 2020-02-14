<?php

namespace App\Http\Controllers;

use App\Core\Services\SIDAProgramService;
use App\Http\Requests\SIDAProgram\SIDAProgramFormRequest;
use App\Http\Requests\SIDAProgram\SIDAProgramFilterRequest;

class SIDAProgramController extends Controller{


	protected $sida_program;



    public function __construct(SIDAProgramService $sida_program){

        $this->sida_program = $sida_program;

    }


    
    public function index(SIDAProgramFilterRequest $request){
        
        return $this->sida_program->fetch($request);

    }

    

    public function create(){
        
        return view('dashboard.sida_program.create');

    }

   

    public function store(SIDAProgramFormRequest $request){
        
        return $this->sida_program->store($request);

    }
 



    public function viewFile($slug){
        
        return $this->sida_program->viewFile($slug);

    }
 



    public function edit($slug){
        
        return $this->sida_program->edit($slug);

    }




    public function update(SIDAProgramFormRequest $request, $slug){
        
        return $this->sida_program->update($request, $slug);

    }

    


    public function destroy($slug){
    	
        return $this->sida_program->destroy($slug);

    }


    
}
