<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\VarietyInterface;

use App\Models\Variety;


class VarietyRepository extends BaseRepository implements VarietyInterface {
    


    protected $variety;



    public function __construct(Variety $variety){

        $this->variety = $variety;
        parent::__construct();

    }





    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $variety = $this->cache->remember('varieties:fetch:' . $key, 240, function() use ($request, $entries){

            $variety = $this->variety->newQuery();
            
            if(isset($request->q)){
                $this->search($variety, $request->q);
            }

            return $this->populate($variety, $entries);

        });

        return $variety;

    }





    public function store($request, $file_location){

        $variety = new Variety;
        $variety->slug = $this->str->random(16);
        $variety->variety_id = $this->getVarietyIdInc();
        $variety->name = $request->name;
        $variety->file_location = $file_location;
        $variety->created_at = $this->carbon->now();
        $variety->updated_at = $this->carbon->now();
        $variety->ip_created = request()->ip();
        $variety->ip_updated = request()->ip();
        $variety->user_created = $this->auth->user()->user_id;
        $variety->user_updated = $this->auth->user()->user_id;
        $variety->save();
        
        return $variety;

    }





    public function update($request, $file_location, $variety){

        $variety->name = $request->name;
        $variety->file_location = $file_location;
        $variety->updated_at = $this->carbon->now();
        $variety->ip_updated = request()->ip();
        $variety->user_updated = $this->auth->user()->user_id;
        $variety->save();

        $variety->varietyData()->delete();

        return $variety;

    }





    public function destroy($variety){

        $variety->delete();
        $variety->varietyData()->delete();
        return $variety;

    }





    public function findBySlug($slug){

        $variety = $this->cache->remember('varieties:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->variety->where('slug', $slug)->first();
        }); 
        
        if(empty($variety)){
            abort(404);
        }

        return $variety;

    }






    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('name', 'LIKE', '%'. $key .'%');
        });

    }





    public function populate($model, $entries){

        return $model->select('name', 'slug')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate($entries);

    }






    public function getVarietyIdInc(){

        $id = 'V10001';

        $variety = $this->variety->select('variety_id')->orderBy('variety_id', 'desc')->first();

        if($variety != null){

            if($variety->variety_id != null){
                $num = str_replace('V', '', $variety->variety_id) + 1;
                $id = 'V' . $num;
            }
        
        }
        
        return $id;
        
    }






}