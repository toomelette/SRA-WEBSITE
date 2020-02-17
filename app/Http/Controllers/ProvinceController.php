<?php

namespace App\Http\Controllers;

use App\Core\Services\ProvinceService;
use App\Http\Requests\Province\ProvinceFormRequest;
use App\Http\Requests\Province\ProvinceFilterRequest;

class ProvinceController extends Controller{



	protected $province;



    public function __construct(ProvinceService $province){

        $this->province = $province;

    }


    
    public function index(ProvinceFilterRequest $request){
        
        return $this->province->fetch($request);

    }

    

    public function create(){
        
        return view('dashboard.province.create');

    }

   

    public function store(ProvinceFormRequest $request){
        
        return $this->province->store($request);

    }
 



    public function edit($slug){
        
        return $this->province->edit($slug);

    }




    public function update(ProvinceFormRequest $request, $slug){
        
        return $this->province->update($request, $slug);

    }

    


    public function destroy($slug){
        
        return $this->province->destroy($slug);

    }


    
}
