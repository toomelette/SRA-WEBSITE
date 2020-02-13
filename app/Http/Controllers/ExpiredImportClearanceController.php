<?php

namespace App\Http\Controllers;

use App\Core\Services\ExpiredImportClearanceService;
use App\Http\Requests\ExpiredImportClearance\ExpiredImportClearanceFormRequest;
use App\Http\Requests\ExpiredImportClearance\ExpiredImportClearanceFilterRequest;

class ExpiredImportClearanceController extends Controller{



	protected $expired_import_clearance;



    public function __construct(ExpiredImportClearanceService $expired_import_clearance){

        $this->expired_import_clearance = $expired_import_clearance;

    }


    
    public function index(ExpiredImportClearanceFilterRequest $request){
        
        return $this->expired_import_clearance->fetch($request);

    }

    

    public function create(){
        
        return view('dashboard.expired_import_clearance.create');

    }

   

    public function store(ExpiredImportClearanceFormRequest $request){
        
        return $this->expired_import_clearance->store($request);

    }
 



    public function viewFile($slug){
        
        return $this->expired_import_clearance->viewFile($slug);

    }
 



    public function edit($slug){
        
        return $this->expired_import_clearance->edit($slug);

    }




    public function update(ExpiredImportClearanceFormRequest $request, $slug){
        
        return $this->expired_import_clearance->update($request, $slug);

    }

    


    public function destroy($slug){
        
        return $this->expired_import_clearance->destroy($slug);

    }


    
}
