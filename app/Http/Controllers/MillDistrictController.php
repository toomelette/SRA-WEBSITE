<?php

namespace App\Http\Controllers;

use App\Core\Services\MillDistrictService;
use App\Http\Requests\MillDistrict\MillDistrictFormRequest;
use App\Http\Requests\MillDistrict\MillDistrictFilterRequest;


class MillDistrictController extends Controller{
    


	protected $mill_district;



    public function __construct(MillDistrictService $mill_district){

        $this->mill_district = $mill_district;

    }


    
    public function index(MillDistrictFilterRequest $request){
        
        return $this->mill_district->fetch($request);

    }

    

    public function create(){
        
        return view('dashboard.mill_district.create');

    }

   

    public function store(MillDistrictFormRequest $request){
        
        return $this->mill_district->store($request);

    }
 



    public function edit($slug){
        
        return $this->mill_district->edit($slug);

    }




    public function update(MillDistrictFormRequest $request, $slug){
        
        return $this->mill_district->update($request, $slug);

    }

    


    public function destroy($slug){
        
        return $this->mill_district->destroy($slug);

    }




}
