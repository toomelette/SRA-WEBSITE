<?php

namespace App\Http\Controllers;


use App\Core\Services\OfficeService;
use App\Http\Requests\Office\OfficeFormRequest;
use App\Http\Requests\Office\OfficeFilterRequest;


class OfficeController extends Controller{




	 protected $office;




    public function __construct(OfficeService $office){

        $this->office = $office;

    }


    

    public function index(OfficeFilterRequest $request){
        
        return $this->office->fetch($request);

    }

    


    public function create(){
        
        return view('dashboard.office.create');

    }

   


    public function store(OfficeFormRequest $request){
        
        return $this->office->store($request);

    }
 



    public function edit($slug){
        
        return $this->office->edit($slug);

    }




    public function update(OfficeFormRequest $request, $slug){
        
        return $this->office->update($request, $slug);

    }

    


    public function destroy($slug){
        
        return $this->office->destroy($slug);

    }




    
}
