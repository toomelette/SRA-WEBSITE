<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SIDAGuidelineInterface;

use App\Models\SIDAGuideline;


class SIDAGuidelineRepository extends BaseRepository implements SIDAGuidelineInterface {
	


    protected $sida_guideline;



	public function __construct(SIDAGuideline $sida_guideline){

        $this->sida_guideline = $sida_guideline;
        parent::__construct();

    }





    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $sida_guidelines = $this->cache->remember('sida_guidelines:fetch:' . $key, 240, function() use ($request, $entries){

            $sida_guideline = $this->sida_guideline->newQuery();
            
            if(isset($request->q)){
                $this->search($sida_guideline, $request->q);
            }

            return $this->populate($sida_guideline, $entries);

        });

        return $sida_guidelines;

    }





    public function guestFetch($request){

        $key = str_slug($request->fullUrl(), '_');

        $sida_guidelines = $this->cache->remember('sida_guidelines:guestFetch:' . $key, 240, function() use ($request){

            $entries = isset($request->e) ? $request->e : 20;

            $sida_guideline = $this->sida_guideline->newQuery();

            if(isset($request->q)){
                $sida_guideline->where('title', 'LIKE', '%'. $request->q .'%')
                               ->orWhere('description', 'LIKE', '%'. $request->q .'%')
                               ->orWhere('year', 'LIKE', '%'. $request->q .'%');
            }

            return $sida_guideline->select('file_location', 'title', 'description', 'year', 'slug')
                                  ->sortable()
                                  ->orderBy('created_at', 'desc')
                                  ->paginate($entries);

        });

        return $sida_guidelines;

    }





    public function store($request, $file_location){

        $sida_guideline = new SIDAGuideline;
        $sida_guideline->slug = $this->str->random(16);
        $sida_guideline->sida_guideline_id = $this->getSidaGuidelineIdInc();
        $sida_guideline->title = $request->title;
        $sida_guideline->year = $request->year;
        $sida_guideline->description = $request->description;
        $sida_guideline->file_location = $file_location;
        $sida_guideline->created_at = $this->carbon->now();
        $sida_guideline->updated_at = $this->carbon->now();
        $sida_guideline->ip_created = request()->ip();
        $sida_guideline->ip_updated = request()->ip();
        $sida_guideline->user_created = $this->auth->user()->user_id;
        $sida_guideline->user_updated = $this->auth->user()->user_id;
        $sida_guideline->save();
        
        return $sida_guideline;

    }





    public function update($request, $file_location, $sida_guideline){
  
        $sida_guideline->title = $request->title;
        $sida_guideline->year = $request->year;
        $sida_guideline->description = $request->description;
        $sida_guideline->file_location = $file_location;
        $sida_guideline->updated_at = $this->carbon->now();
        $sida_guideline->ip_updated = request()->ip();
        $sida_guideline->user_updated = $this->auth->user()->user_id;
        $sida_guideline->save();

        return $sida_guideline;

    }





    public function destroy($sida_guideline){

        $sida_guideline->delete();
        return $sida_guideline;

    }





    public function findBySlug($slug){

        $sida_guideline = $this->cache->remember('sida_guidelines:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->sida_guideline->where('slug', $slug)->first();
        }); 
        
        if(empty($sida_guideline)){
            abort(404);
        }

        return $sida_guideline;

    }






    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('title', 'LIKE', '%'. $key .'%')
                      ->orwhere('description', 'LIKE', '%'. $key .'%')
                      ->orwhere('year', 'LIKE', '%'. $key .'%');
        });

    }





    public function populate($model, $entries){

        return $model->select('file_location', 'title', 'year', 'description', 'slug')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate($entries);

    }






    public function getSidaGuidelineIdInc(){

        $id = 'SG10001';

        $sida_guideline = $this->sida_guideline->select('sida_guideline_id')->orderBy('sida_guideline_id', 'desc')->first();

        if($sida_guideline != null){

            if($sida_guideline->sida_guideline_id != null){
                $num = str_replace('SG', '', $sida_guideline->sida_guideline_id) + 1;
                $id = 'SG' . $num;
            }
        
        }
        
        return $id;
        
    }






}