<?php

namespace App\Http\Controllers;

use App\Core\Services\NoticeOfAwardService;
use App\Http\Requests\NoticeOfAward\NoticeOfAwardFormRequest;
use App\Http\Requests\NoticeOfAward\NoticeOfAwardFilterRequest;


class NoticeOfAwardController extends Controller{




	protected $notice_of_award;




    public function __construct(NoticeOfAwardService $notice_of_award){

        $this->notice_of_award = $notice_of_award;

    }


    
    public function index(NoticeOfAwardFilterRequest $request){
        
        return $this->notice_of_award->fetch($request);

    }

    

    public function create(){
        
        return view('dashboard.notice_of_award.create');

    }

   

    public function store(NoticeOfAwardFormRequest $request){
        
        return $this->notice_of_award->store($request);

    }
 



    public function viewFile($slug, $type){
        
        return $this->notice_of_award->viewFile($slug, $type);

    }
 



    public function edit($slug){
        
        return $this->notice_of_award->edit($slug);

    }




    public function update(NoticeOfAwardFormRequest $request, $slug){
        
        return $this->notice_of_award->update($request, $slug);

    }

    


    public function destroy($slug){
        
        return $this->notice_of_award->destroy($slug);

    }



    
}
