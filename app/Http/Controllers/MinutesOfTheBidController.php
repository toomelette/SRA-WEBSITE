<?php

namespace App\Http\Controllers;

use App\Core\Services\MinutesOfTheBidService;
use App\Http\Requests\MinutesOfTheBid\MinutesOfTheBidFormRequest;
use App\Http\Requests\MinutesOfTheBid\MinutesOfTheBidFilterRequest;


class MinutesOfTheBidController extends Controller{




	protected $minutes_of_the_bid;



    public function __construct(MinutesOfTheBidService $minutes_of_the_bid){

        $this->minutes_of_the_bid = $minutes_of_the_bid;

    }


    
    public function index(MinutesOfTheBidFilterRequest $request){
        
        return $this->minutes_of_the_bid->fetch($request);

    }

    

    public function create(){
        
        return view('dashboard.minutes_of_the_bid.create');

    }

   

    public function store(MinutesOfTheBidFormRequest $request){
        
        return $this->minutes_of_the_bid->store($request);

    }
 



    public function viewFile($slug){
        
        return $this->minutes_of_the_bid->viewFile($slug);

    }
 



    public function edit($slug){
        
        return $this->minutes_of_the_bid->edit($slug);

    }




    public function update(MinutesOfTheBidFormRequest $request, $slug){
        
        return $this->minutes_of_the_bid->update($request, $slug);

    }

    


    public function destroy($slug){
    	
        return $this->minutes_of_the_bid->destroy($slug);

    }


    
}
