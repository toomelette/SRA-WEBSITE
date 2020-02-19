<?php

namespace App\Http\Controllers;

use App\Core\Services\NoticeToProceedService;
use App\Http\Requests\NoticeToProceed\NoticeToProceedFormRequest;
use App\Http\Requests\NoticeToProceed\NoticeToProceedFilterRequest;


class NoticeToProceedController extends Controller{


	protected $notice_to_proceed;




    public function __construct(NoticeToProceedService $notice_to_proceed){

        $this->notice_to_proceed = $notice_to_proceed;

    }


    
    public function index(NoticeToProceedFilterRequest $request){
        
        return $this->notice_to_proceed->fetch($request);

    }

    

    public function create(){
        
        return view('dashboard.notice_to_proceed.create');

    }

   

    public function store(NoticeToProceedFormRequest $request){
        
        return $this->notice_to_proceed->store($request);

    }
 



    public function viewFile($slug, $type){
        
        return $this->notice_to_proceed->viewFile($slug, $type);

    }
 



    public function edit($slug){
        
        return $this->notice_to_proceed->edit($slug);

    }




    public function update(NoticeToProceedFormRequest $request, $slug){
        
        return $this->notice_to_proceed->update($request, $slug);

    }

    


    public function destroy($slug){
        
        return $this->notice_to_proceed->destroy($slug);

    }
    

    
}
