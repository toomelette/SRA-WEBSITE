<?php

namespace App\Http\Controllers;

use App\Core\Services\AdminCornerService;
use App\Http\Requests\AdminCorner\AdminCornerFormRequest;
use App\Http\Requests\AdminCorner\AdminCornerFilterRequest;

class AdminCornerController extends Controller{



	 protected $admin_corner;



    public function __construct(AdminCornerService $admin_corner){

        $this->admin_corner = $admin_corner;

    }


    
    public function index(AdminCornerFilterRequest $request){
        
        return $this->admin_corner->fetch($request);

    }

    

    public function create(){
        
        return view('dashboard.admin_corner.create');

    }

   

    public function store(AdminCornerFormRequest $request){
        
        return $this->admin_corner->store($request);

    }
 



    public function viewImg($slug){
        
        return $this->admin_corner->viewImg($slug);

    }
 



    public function edit($slug){
        
        return $this->admin_corner->edit($slug);

    }




    public function update(AdminCornerFormRequest $request, $slug){
        
        return $this->admin_corner->update($request, $slug);

    }

    


    public function destroy($slug){
        
        return $this->admin_corner->destroy($slug);

    }





    
}
