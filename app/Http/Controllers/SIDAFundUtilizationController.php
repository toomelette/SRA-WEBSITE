<?php

namespace App\Http\Controllers;

use App\Core\Services\SIDAFundUtilizationService;
use App\Http\Requests\SIDAFundUtilization\SIDAFundUtilizationFormRequest;
use App\Http\Requests\SIDAFundUtilization\SIDAFundUtilizationFilterRequest;

class SIDAFundUtilizationController extends Controller{




	protected $sida_fund_utilization;



    public function __construct(SIDAFundUtilizationService $sida_fund_utilization){

        $this->sida_fund_utilization = $sida_fund_utilization;

    }


    
    public function index(SIDAFundUtilizationFilterRequest $request){
        
        return $this->sida_fund_utilization->fetch($request);

    }

    

    public function create(){
        
        return view('dashboard.sida_fund_utilization.create');

    }

   

    public function store(SIDAFundUtilizationFormRequest $request){
        
        return $this->sida_fund_utilization->store($request);

    }
 



    public function viewFile($slug){
        
        return $this->sida_fund_utilization->viewFile($slug);

    }
 



    public function edit($slug){
        
        return $this->sida_fund_utilization->edit($slug);

    }




    public function update(SIDAFundUtilizationFormRequest $request, $slug){
        
        return $this->sida_fund_utilization->update($request, $slug);

    }

    


    public function destroy($slug){
        
        return $this->sida_fund_utilization->destroy($slug);

    }




    
}
