<?php

namespace App\Http\Controllers;


use App\Core\Services\HistoricalDataService;
use App\Http\Requests\HistoricalData\HistoricalDataFormRequest;
use App\Http\Requests\HistoricalData\HistoricalDataFilterRequest;


class HistoricalDataController extends Controller{



	protected $historical_data;



    public function __construct(HistoricalDataService $historical_data){

        $this->historical_data = $historical_data;

    }


    
    public function index(HistoricalDataFilterRequest $request){
        
        return $this->historical_data->fetch($request);

    }

    

    public function create(){
        
        return view('dashboard.historical_data.create');

    }

   

    public function store(HistoricalDataFormRequest $request){
        
        return $this->historical_data->store($request);

    }
 



    public function viewFile($slug){
        
        return $this->historical_data->viewFile($slug);

    }
 



    public function edit($slug){
        
        return $this->historical_data->edit($slug);

    }




    public function update(HistoricalDataFormRequest $request, $slug){
        
        return $this->historical_data->update($request, $slug);

    }

    


    public function destroy($slug){
        
        return $this->historical_data->destroy($slug);

    }


    
}
