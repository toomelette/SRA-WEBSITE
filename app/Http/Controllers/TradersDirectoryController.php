<?php

namespace App\Http\Controllers;

use App\Core\Services\TradersDirectoryService;
use App\Http\Requests\TradersDirectory\TradersDirectoryFormRequest;
use App\Http\Requests\TradersDirectory\TradersDirectoryFilterRequest;

class TradersDirectoryController extends Controller{


	 protected $traders_directory;



    public function __construct(TradersDirectoryService $traders_directory){

        $this->traders_directory = $traders_directory;

    }


    
    public function index(TradersDirectoryFilterRequest $request){
        
        return $this->traders_directory->fetch($request);

    }

    

    public function create(){
        
        return view('dashboard.traders_directory.create');

    }

   

    public function store(TradersDirectoryFormRequest $request){
        
        return $this->traders_directory->store($request);

    }
 



    public function viewFile($slug){
        
        return $this->traders_directory->viewFile($slug);

    }
 



    public function edit($slug){
        
        return $this->traders_directory->edit($slug);

    }




    public function update(TradersDirectoryFormRequest $request, $slug){
        
        return $this->traders_directory->update($request, $slug);

    }

    


    public function destroy($slug){
        
        return $this->traders_directory->destroy($slug);

    }

    
}
