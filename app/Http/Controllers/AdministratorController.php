<?php

namespace App\Http\Controllers;

use App\Core\Services\AdministratorService;
use App\Http\Requests\Administrator\AdministratorFormRequest;
use App\Http\Requests\Administrator\AdministratorFilterRequest;

class AdministratorController extends Controller{



	 protected $administrator;



    public function __construct(AdministratorService $administrator){

        $this->administrator = $administrator;

    }


    
    public function index(AdministratorFilterRequest $request){
        
        return $this->administrator->fetch($request);

    }

    

    public function create(){
        
        return view('dashboard.administrator.create');

    }

   

    public function store(AdministratorFormRequest $request){
        
        return $this->administrator->store($request);

    }
 



    public function viewAvatar($slug){
        
        return $this->administrator->viewAvatar($slug);

    }
 



    public function edit($slug){
        
        return $this->administrator->edit($slug);

    }




    public function update(AdministratorFormRequest $request, $slug){
        
        return $this->administrator->update($request, $slug);

    }

    


    public function destroy($slug){
        
        return $this->administrator->destroy($slug);

    }





    
}
