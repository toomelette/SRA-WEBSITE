<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\ProvinceInterface;


use App\Models\Province;


class ProvinceRepository extends BaseRepository implements ProvinceInterface {
	



    protected $province;




	public function __construct(Province $province){

        $this->province = $province;
        parent::__construct();

    }



    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $provinces = $this->cache->remember('provinces:fetch:' . $key, 240, function() use ($request, $entries){

            $province = $this->province->newQuery();
            
            if(isset($request->q)){
                $this->search($province, $request->q);
            }

            return $this->populate($province, $entries);

        });

        return $provinces;

    }





    public function store($request){

        $province = new Province;
        $province->slug = $this->str->random(16);
        $province->province_id = $this->getProvinceIdInc();
        $province->name = $request->name;
        $province->created_at = $this->carbon->now();
        $province->updated_at = $this->carbon->now();
        $province->ip_created = request()->ip();
        $province->ip_updated = request()->ip();
        $province->user_created = $this->auth->user()->user_id;
        $province->user_updated = $this->auth->user()->user_id;
        $province->save();
        
        return $province;

    }





    public function update($request, $slug){

        $province = $this->findBySlug($slug);
        $province->name = $request->name;
        $province->updated_at = $this->carbon->now();
        $province->ip_updated = request()->ip();
        $province->user_updated = $this->auth->user()->user_id;
        $province->save();

        return $province;

    }





    public function destroy($slug){

        $province = $this->findBySlug($slug);
        $province->delete();

        return $province;

    }





    public function findBySlug($slug){

        $province = $this->cache->remember('provinces:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->province->where('slug', $slug)->first();
        }); 
        
        if(empty($province)){
            abort(404);
        }

        return $province;

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






    public function getProvinceIdInc(){

        $id = 'P10001';

        $province = $this->province->select('province_id')->orderBy('province_id', 'desc')->first();

        if($province != null){

            if($province->province_id != null){
                $num = str_replace('P', '', $province->province_id) + 1;
                $id = 'P' . $num;
            }
        
        }
        
        return $id;
        
    }





    public function getAll(){

        $provinces = $this->cache->remember('provinces:getAll', 240, function(){
            return $this->province->select('province_id','name')->get();
        });
        
        return $provinces;

    }





}