<?php

namespace App\Http\Controllers;

use App\Core\Services\IndustryStatisticService;
use App\Http\Requests\IndustryStatistic\IndustryStatisticFormRequest;
use App\Http\Requests\IndustryStatistic\IndustryStatisticFilterRequest;


class IndustryStatisticController extends Controller{




	 protected $industry_statistic;



    public function __construct(IndustryStatisticService $industry_statistic){

        $this->industry_statistic = $industry_statistic;

    }


    
    public function index(IndustryStatisticFilterRequest $request){
        
        return $this->industry_statistic->fetch($request);

    }

    

    public function create(){
        
        return view('dashboard.industry_statistic.create');

    }

   

    public function store(IndustryStatisticFormRequest $request){
        
        return $this->industry_statistic->store($request);

    }
 



    public function viewFile($slug){
        
        return $this->industry_statistic->viewFile($slug);

    }
 



    public function edit($slug){
        
        return $this->industry_statistic->edit($slug);

    }




    public function update(IndustryStatisticFormRequest $request, $slug){
        
        return $this->industry_statistic->update($request, $slug);

    }

    


    public function destroy($slug){
        
        return $this->industry_statistic->destroy($slug);

    }


    

}
