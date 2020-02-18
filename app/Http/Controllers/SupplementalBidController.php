<?php

namespace App\Http\Controllers;

use App\Core\Services\SupplementalBidService;
use App\Http\Requests\SupplementalBid\SupplementalBidFormRequest;
use App\Http\Requests\SupplementalBid\SupplementalBidFilterRequest;

class SupplementalBidController extends Controller{



	protected $supplemental_bid;



    public function __construct(SupplementalBidService $supplemental_bid){

        $this->supplemental_bid = $supplemental_bid;

    }


    
    public function index(SupplementalBidFilterRequest $request){
        
        return $this->supplemental_bid->fetch($request);

    }

    

    public function create(){
        
        return view('dashboard.supplemental_bid.create');

    }

   

    public function store(SupplementalBidFormRequest $request){
        
        return $this->supplemental_bid->store($request);

    }
 



    public function viewFile($slug){
        
        return $this->supplemental_bid->viewFile($slug);

    }
 



    public function edit($slug){
        
        return $this->supplemental_bid->edit($slug);

    }




    public function update(SupplementalBidFormRequest $request, $slug){
        
        return $this->supplemental_bid->update($request, $slug);

    }

    


    public function destroy($slug){
    	
        return $this->supplemental_bid->destroy($slug);

    }


    
}
