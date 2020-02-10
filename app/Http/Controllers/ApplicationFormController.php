<?php

namespace App\Http\Controllers;


use App\Core\Services\ApplicationFormService;
use App\Http\Requests\ApplicationForm\ApplicationFormFormRequest;
use App\Http\Requests\ApplicationForm\ApplicationFormFilterRequest;

class ApplicationFormController extends Controller{




	 protected $application_form;



    public function __construct(ApplicationFormService $application_form){

        $this->application_form = $application_form;

    }


    
    public function index(ApplicationFormFilterRequest $request){
        
        return $this->application_form->fetch($request);

    }

    

    public function create(){
        
        return view('dashboard.application_form.create');

    }

   

    public function store(ApplicationFormFormRequest $request){
        
        return $this->application_form->store($request);

    }
 



    public function viewFile($slug){
        
        return $this->application_form->viewFile($slug);

    }
 



    public function edit($slug){
        
        return $this->application_form->edit($slug);

    }




    public function update(ApplicationFormFormRequest $request, $slug){
        
        return $this->application_form->update($request, $slug);

    }

    


    public function destroy($slug){
        
        return $this->application_form->destroy($slug);

    }



    
}
