<?php

namespace App\Http\Controllers;

use App\Core\Services\NewsService;
use App\Http\Requests\News\NewsFormRequest;
use App\Http\Requests\News\NewsFilterRequest;

class NewsController extends Controller{


	 protected $news;



    public function __construct(NewsService $news){

        $this->news = $news;

    }


    
    public function index(NewsFilterRequest $request){
        
        return $this->news->fetch($request);

    }

    

    public function create(){
        
        return view('dashboard.news.create');

    }

   

    public function store(NewsFormRequest $request){
        
        return $this->news->store($request);

    }
 



    public function viewFile($slug){
        
        return $this->news->viewFile($slug);

    }
 



    public function viewImg($slug){
        
        return $this->news->viewImg($slug);

    }
 



    public function show($slug){
        
        return $this->news->show($slug);

    }
 



    public function edit($slug){
        
        return $this->news->edit($slug);

    }




    public function update(NewsFormRequest $request, $slug){
        
        return $this->news->update($request, $slug);

    }

    


    public function destroy($slug){
        
        return $this->news->destroy($slug);

    }

    


}
