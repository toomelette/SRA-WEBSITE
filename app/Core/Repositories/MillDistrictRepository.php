<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\MillDistrictInterface;


use App\Models\MillDistrict;


class MillDistrictRepository extends BaseRepository implements MillDistrictInterface {
	



    protected $mill_district;




	public function __construct(MillDistrict $mill_district){

        $this->mill_district = $mill_district;
        parent::__construct();

    }




    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $mill_districts = $this->cache->remember('mill_districts:fetch:' . $key, 240, function() use ($request, $entries){

            $mill_district = $this->mill_district->newQuery();
            
            if(isset($request->q)){
                $this->search($mill_district, $request->q);
            }

            return $this->populate($mill_district, $entries);

        });

        return $mill_districts;

    }





    public function store($request){

        $mill_district = new MillDistrict;
        $mill_district->slug = $this->str->random(16);
        $mill_district->mill_district_id = $this->getMillDistrictIdInc();
        $mill_district->province_id = $request->province_id;
        $mill_district->name = $request->name;
        $mill_district->created_at = $this->carbon->now();
        $mill_district->updated_at = $this->carbon->now();
        $mill_district->ip_created = request()->ip();
        $mill_district->ip_updated = request()->ip();
        $mill_district->user_created = $this->auth->user()->user_id;
        $mill_district->user_updated = $this->auth->user()->user_id;
        $mill_district->save();
        
        return $mill_district;

    }





    public function update($request, $slug){

        $mill_district = $this->findBySlug($slug);
        $mill_district->province_id = $request->province_id;
        $mill_district->name = $request->name;
        $mill_district->updated_at = $this->carbon->now();
        $mill_district->ip_updated = request()->ip();
        $mill_district->user_updated = $this->auth->user()->user_id;
        $mill_district->save();

        return $mill_district;

    }





    public function destroy($slug){

        $mill_district = $this->findBySlug($slug);
        $mill_district->delete();

        return $mill_district;

    }





    public function findBySlug($slug){

        $mill_district = $this->cache->remember('mill_districts:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->mill_district->where('slug', $slug)->first();
        }); 
        
        if(empty($mill_district)){
            abort(404);
        }

        return $mill_district;

    }






    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('name', 'LIKE', '%'. $key .'%')
                      ->orwhereHas('province', function ($model) use ($key) {
                            $model->where('name', 'LIKE', '%'. $key .'%');
                        });
        });

    }





    public function populate($model, $entries){

        return $model->select('province_id', 'name', 'slug')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate($entries);

    }






    public function getMillDistrictIdInc(){

        $id = 'MD10001';

        $mill_district = $this->mill_district->select('mill_district_id')->orderBy('mill_district_id', 'desc')->first();

        if($mill_district != null){

            if($mill_district->mill_district_id != null){
                $num = str_replace('MD', '', $mill_district->mill_district_id) + 1;
                $id = 'MD' . $num;
            }
        
        }
        
        return $id;
        
    }





    public function getAll(){

        $mill_districts = $this->cache->remember('mill_districts:getAll', 240, function(){
            return $this->mill_district->select('mill_district_id','name')->get();
        });
        
        return $mill_districts;

    }





}