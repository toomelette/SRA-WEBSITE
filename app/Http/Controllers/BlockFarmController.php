<?php

namespace App\Http\Controllers;

use App\Core\Services\BlockFarmService;
use App\Http\Requests\BlockFarm\BlockFarmFormRequest;
use App\Http\Requests\BlockFarm\BlockFarmFilterRequest;



class BlockFarmController extends Controller{



	protected $block_farm;



    public function __construct(BlockFarmService $block_farm){

        $this->block_farm = $block_farm;

    }


    
    public function index(BlockFarmFilterRequest $request){
        
        return $this->block_farm->fetch($request);

    }

    

    public function create(){
        
        return view('dashboard.block_farm.create');

    }

   

    public function store(BlockFarmFormRequest $request){
        
        return $this->block_farm->store($request);

    }
 



    public function viewFile($slug){
        
        return $this->block_farm->viewFile($slug);

    }
 



    public function edit($slug){
        
        return $this->block_farm->edit($slug);

    }




    public function update(BlockFarmFormRequest $request, $slug){
        
        return $this->block_farm->update($request, $slug);

    }

    


    public function destroy($slug){
    	
        return $this->block_farm->destroy($slug);

    }



    
}
