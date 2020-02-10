<?php

namespace App\Http\Controllers;

use App\Core\Services\SMSFormService;
use App\Http\Requests\SMSForm\SMSFormFormRequest;
use App\Http\Requests\SMSForm\SMSFormFilterRequest;

class SMSFormController extends Controller{



	protected $sms_form;



    public function __construct(SMSFormService $sms_form){

        $this->sms_form = $sms_form;

    }


    
    public function index(SMSFormFilterRequest $request){
        
        return $this->sms_form->fetch($request);

    }

    

    public function create(){
        
        return view('dashboard.sms_form.create');

    }

   

    public function store(SMSFormFormRequest $request){
        
        return $this->sms_form->store($request);

    }
 



    public function viewFile($slug){
        
        return $this->sms_form->viewFile($slug);

    }
 



    public function edit($slug){
        
        return $this->sms_form->edit($slug);

    }




    public function update(SMSFormFormRequest $request, $slug){
        
        return $this->sms_form->update($request, $slug);

    }

    


    public function destroy($slug){
    	
        return $this->sms_form->destroy($slug);

    }


    
}
