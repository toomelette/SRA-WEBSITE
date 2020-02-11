<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\ResearchInterface;

use App\Models\Research;


class ResearchRepository extends BaseRepository implements ResearchInterface {
	


    protected $research;



	public function __construct(Research $research){

        $this->research = $research;
        parent::__construct();

    }





    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $researches = $this->cache->remember('researches:fetch:' . $key, 240, function() use ($request, $entries){

            $research = $this->research->newQuery();
            
            if(isset($request->q)){
                $this->search($research, $request->q);
            }

            return $this->populate($research, $entries);

        });

        return $researches;

    }





    public function store($request){

        $research = new Research;
        $research->slug = $this->str->random(16);
        $research->research_id = $this->getResearchIdInc();
        $research->title = $request->title;
        $research->content = $request->content;
        $research->created_at = $this->carbon->now();
        $research->updated_at = $this->carbon->now();
        $research->ip_created = request()->ip();
        $research->ip_updated = request()->ip();
        $research->user_created = $this->auth->user()->user_id;
        $research->user_updated = $this->auth->user()->user_id;
        $research->save();
        
        return $research;

    }





    public function update($request, $slug){

        $research = $this->findBySlug($slug);
        $research->title = $request->title;
        $research->content = $request->content;
        $research->ip_updated = request()->ip();
        $research->user_updated = $this->auth->user()->user_id;
        $research->save();

        return $research;

    }





    public function destroy($slug){

        $research = $this->findBySlug($slug);
        $research->delete();

        return $research;

    }





    public function findBySlug($slug){

        $research = $this->cache->remember('researches:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->research->where('slug', $slug)->first();
        }); 
        
        if(empty($research)){
            abort(404);
        }

        return $research;

    }






    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('title', 'LIKE', '%'. $key .'%');
        });

    }





    public function populate($model, $entries){

        return $model->select('title', 'content', 'slug')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate($entries);

    }






    public function getResearchIdInc(){

        $id = 'R10001';

        $research = $this->research->select('research_id')->orderBy('research_id', 'desc')->first();

        if($research != null){

            if($research->research_id != null){
                $num = str_replace('R', '', $research->research_id) + 1;
                $id = 'R' . $num;
            }
        
        }
        
        return $id;
        
    }






}