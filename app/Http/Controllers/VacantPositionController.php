<?php

namespace App\Http\Controllers;

use App\Core\Services\VacantPositionService;
use App\Http\Requests\VacantPosition\VacantPositionFormRequest;
use App\Http\Requests\VacantPosition\VacantPositionFilterRequest;

class VacantPositionController extends Controller{


	protected $vacant_position;


    public function __construct(VacantPositionService $vacant_position){
        $this->vacant_position = $vacant_position;
    }

    
    public function index(VacantPositionFilterRequest $request){
        return $this->vacant_position->fetch($request);
    }

    
    public function create(){
        return view('dashboard.vacant_position.create');
    }

   
    public function store(VacantPositionFormRequest $request){
        return $this->vacant_position->store($request);
    }


    public function viewFile($slug){  
        return $this->vacant_position->viewFile($slug);
    }
 

    public function edit($slug){
        return $this->vacant_position->edit($slug);
    }


    public function update(VacantPositionFormRequest $request, $slug){
        return $this->vacant_position->update($request, $slug);
    }

    
    public function destroy($slug){
        return $this->vacant_position->destroy($slug);
    }


    
}
