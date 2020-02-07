<?php

namespace App\Http\Controllers;


use App\Core\Services\OfficialService;
use App\Http\Requests\Official\OfficialFormRequest;
use App\Http\Requests\Official\OfficialFilterRequest;

class OfficialController extends Controller{




	protected $official;




    public function __construct(OfficialService $official){

        $this->official = $official;

    }


    

    public function index(OfficialFilterRequest $request){
        
        return $this->official->fetch($request);

    }

    


    public function create(){
        
        return view('dashboard.official.create');

    }

   


    public function store(OfficialFormRequest $request){
        
        return $this->official->store($request);

    }
 



    public function viewAvatar($slug){
        
        return $this->official->viewAvatar($slug);

    }
 



    public function show($slug){
        
        return $this->official->show($slug);

    }
 



    public function edit($slug){
        
        return $this->official->edit($slug);

    }




    public function update(OfficialFormRequest $request, $slug){
        
        return $this->official->update($request, $slug);

    }

    


    public function destroy($slug){
        
        return $this->official->destroy($slug);

    }


    

}
