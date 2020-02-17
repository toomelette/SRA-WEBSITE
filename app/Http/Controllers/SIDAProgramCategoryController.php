<?php

namespace App\Http\Controllers;

use App\Core\Services\SIDAProgramCategoryService;
use App\Http\Requests\SIDAProgramCategory\SIDAProgramCategoryFormRequest;
use App\Http\Requests\SIDAProgramCategory\SIDAProgramCategoryFilterRequest;


class SIDAProgramCategoryController extends Controller{
    


	protected $sida_program_category;



    public function __construct(SIDAProgramCategoryService $sida_program_category){

        $this->sida_program_category = $sida_program_category;

    }


    
    public function index(SIDAProgramCategoryFilterRequest $request){
        
        return $this->sida_program_category->fetch($request);

    }

    

    public function create(){
        
        return view('dashboard.sida_program_category.create');

    }

   

    public function store(SIDAProgramCategoryFormRequest $request){
        
        return $this->sida_program_category->store($request);

    }
 



    public function edit($slug){
        
        return $this->sida_program_category->edit($slug);

    }




    public function update(SIDAProgramCategoryFormRequest $request, $slug){
        
        return $this->sida_program_category->update($request, $slug);

    }

    


    public function destroy($slug){
        
        return $this->sida_program_category->destroy($slug);

    }




    
}
