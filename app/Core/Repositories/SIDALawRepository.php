<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SIDALawInterface;

use App\Models\SIDALaw;


class SIDALawRepository extends BaseRepository implements SIDALawInterface {
	


    protected $sida_law;



	public function __construct(SIDALaw $sida_law){

        $this->sida_law = $sida_law;
        parent::__construct();

    }





    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $sida_laws = $this->cache->remember('sida_laws:fetch:' . $key, 240, function() use ($request, $entries){

            $sida_law = $this->sida_law->newQuery();
            
            if(isset($request->q)){
                $this->search($sida_law, $request->q);
            }

            return $this->populate($sida_law, $entries);

        });

        return $sida_laws;

    }





    public function store($request, $file_location){

        $sida_law = new SIDALaw;
        $sida_law->slug = $this->str->random(16);
        $sida_law->sida_law_id = $this->getSidaLawIdInc();
        $sida_law->title = $request->title;
        $sida_law->year = $request->year;
        $sida_law->description = $request->description;
        $sida_law->file_location = $file_location;
        $sida_law->created_at = $this->carbon->now();
        $sida_law->updated_at = $this->carbon->now();
        $sida_law->ip_created = request()->ip();
        $sida_law->ip_updated = request()->ip();
        $sida_law->user_created = $this->auth->user()->user_id;
        $sida_law->user_updated = $this->auth->user()->user_id;
        $sida_law->save();
        
        return $sida_law;

    }





    public function update($request, $file_location, $sida_law){
  
        $sida_law->title = $request->title;
        $sida_law->year = $request->year;
        $sida_law->description = $request->description;
        $sida_law->file_location = $file_location;
        $sida_law->updated_at = $this->carbon->now();
        $sida_law->ip_updated = request()->ip();
        $sida_law->user_updated = $this->auth->user()->user_id;
        $sida_law->save();

        return $sida_law;

    }





    public function destroy($sida_law){

        $sida_law->delete();
        return $sida_law;

    }





    public function findBySlug($slug){

        $sida_law = $this->cache->remember('sida_laws:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->sida_law->where('slug', $slug)->first();
        }); 
        
        if(empty($sida_law)){
            abort(404);
        }

        return $sida_law;

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






    public function getSidaLawIdInc(){

        $id = 'SL10001';

        $sida_law = $this->sida_law->select('sida_law_id')->orderBy('sida_law_id', 'desc')->first();

        if($sida_law != null){

            if($sida_law->sida_law_id != null){
                $num = str_replace('SL', '', $sida_law->sida_law_id) + 1;
                $id = 'SL' . $num;
            }
        
        }
        
        return $id;
        
    }







}