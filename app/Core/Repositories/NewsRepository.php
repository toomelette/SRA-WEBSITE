<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\NewsInterface;

use App\Models\News;


class NewsRepository extends BaseRepository implements NewsInterface {
	


    protected $news;



	public function __construct(News $news){

        $this->news = $news;
        parent::__construct();

    }





    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $news = $this->cache->remember('news:fetch:' . $key, 240, function() use ($request, $entries){

            $news = $this->news->newQuery();
            
            if(isset($request->q)){
                $this->search($news, $request->q);
            }

            return $this->populate($news, $entries);

        });

        return $news;

    }





    public function store($request, $file_location){

        $news = new News;
        $news->slug = $this->str->random(16);
        $news->news_id = $this->getNewsIdInc();
        $news->type = $request->type;
        $news->file_location = $file_location;
        $news->url = $request->url;
        $news->title = $request->title;
        $news->content = $request->content;
        $news->created_at = $this->carbon->now();
        $news->updated_at = $this->carbon->now();
        $news->ip_created = request()->ip();
        $news->ip_updated = request()->ip();
        $news->user_created = $this->auth->user()->user_id;
        $news->user_updated = $this->auth->user()->user_id;
        $news->save();
        
        return $news;

    }





    public function update($request, $file_location, $news){

        $news->type = $request->type;
        $news->file_location = $file_location;
        $news->url = $request->url;
        $news->title = $request->title;
        $news->content = $request->content;
        $news->updated_at = $this->carbon->now();
        $news->ip_updated = request()->ip();
        $news->user_updated = $this->auth->user()->user_id;
        $news->save();

        return $news;

    }





    public function destroy($news){

        $news->delete();
        return $news;

    }





    public function findBySlug($slug){

        $news = $this->cache->remember('news:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->news->where('slug', $slug)->first();
        }); 
        
        if(empty($news)){
            abort(404);
        }

        return $news;

    }






    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('title', 'LIKE', '%'. $key .'%')
                      ->orWhere('content', 'LIKE', '%'. $key .'%');
        });

    }





    public function populate($model, $entries){

        return $model->select('type', 'file_location', 'url', 'title', 'content', 'updated_at', 'slug')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate($entries);

    }






    public function getNewsIdInc(){

        $id = 'N10001';

        $news = $this->news->select('news_id')->orderBy('news_id', 'desc')->first();

        if($news != null){

            if($news->news_id != null){
                $num = str_replace('N', '', $news->news_id) + 1;
                $id = 'N' . $num;
            }
        
        }
        
        return $id;
        
    }






}