<?php

namespace App\Http\Controllers;

use App\Core\Services\PolicyService;
use App\Http\Requests\Policy\PolicyFormRequest;
use App\Http\Requests\Policy\PolicyFilterRequest;

class PolicyController extends Controller{


	protected $policy;



    public function __construct(PolicyService $policy){

        $this->policy = $policy;

    }


    
    public function index(PolicyFilterRequest $request){
        
        return $this->policy->fetch($request);

    }

    

    public function create(){
        
        return view('dashboard.policy.create');

    }

   

    public function store(PolicyFormRequest $request){
        
        return $this->policy->store($request);

    }
 



    public function viewFile($slug){
        
        return $this->policy->viewFile($slug);

    }
 



    public function edit($slug){
        
        return $this->policy->edit($slug);

    }




    public function update(PolicyFormRequest $request, $slug){
        
        return $this->policy->update($request, $slug);

    }

    


    public function destroy($slug){
        
        return $this->policy->destroy($slug);

    }

    
}
