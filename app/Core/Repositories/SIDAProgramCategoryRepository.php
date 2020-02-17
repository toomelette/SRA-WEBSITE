<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SIDAProgramCategoryInterface;


use App\Models\SIDAProgramCategory;


class SIDAProgramCategoryRepository extends BaseRepository implements SIDAProgramCategoryInterface {
	



    protected $sida_program_category;




	public function __construct(SIDAProgramCategory $sida_program_category){

        $this->sida_program_category = $sida_program_category;
        parent::__construct();

    }



    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $sida_program_categories = $this->cache->remember('sida_program_categories:fetch:' . $key, 240, function() use ($request, $entries){

            $sida_program_category = $this->sida_program_category->newQuery();
            
            if(isset($request->q)){
                $this->search($sida_program_category, $request->q);
            }

            return $this->populate($sida_program_category, $entries);

        });

        return $sida_program_categories;

    }





    public function store($request){

        $sida_program_category = new SIDAProgramCategory;
        $sida_program_category->slug = $this->str->random(16);
        $sida_program_category->sida_program_cat_id = $this->getSidaProgramCatIdInc();
        $sida_program_category->name = $request->name;
        $sida_program_category->created_at = $this->carbon->now();
        $sida_program_category->updated_at = $this->carbon->now();
        $sida_program_category->ip_created = request()->ip();
        $sida_program_category->ip_updated = request()->ip();
        $sida_program_category->user_created = $this->auth->user()->user_id;
        $sida_program_category->user_updated = $this->auth->user()->user_id;
        $sida_program_category->save();
        
        return $sida_program_category;

    }





    public function update($request, $slug){

        $sida_program_category = $this->findBySlug($slug);
        $sida_program_category->name = $request->name;
        $sida_program_category->updated_at = $this->carbon->now();
        $sida_program_category->ip_updated = request()->ip();
        $sida_program_category->user_updated = $this->auth->user()->user_id;
        $sida_program_category->save();

        return $sida_program_category;

    }





    public function destroy($slug){

        $sida_program_category = $this->findBySlug($slug);
        $sida_program_category->delete();

        return $sida_program_category;

    }





    public function findBySlug($slug){

        $sida_program_category = $this->cache->remember('sida_program_categories:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->sida_program_category->where('slug', $slug)->first();
        }); 
        
        if(empty($sida_program_category)){
            abort(404);
        }

        return $sida_program_category;

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






    public function getSidaProgramCatIdInc(){

        $id = 'SPC10001';

        $sida_program_category = $this->sida_program_category->select('sida_program_cat_id')->orderBy('sida_program_cat_id', 'desc')->first();

        if($sida_program_category != null){

            if($sida_program_category->sida_program_cat_id != null){
                $num = str_replace('SPC', '', $sida_program_category->sida_program_cat_id) + 1;
                $id = 'SPC' . $num;
            }
        
        }
        
        return $id;
        
    }





    public function getAll(){

        $sida_program_categories = $this->cache->remember('sida_program_categories:getAll', 240, function(){
            return $this->sida_program_category->select('sida_program_cat_id','name')->get();
        });
        
        return $sida_program_categories;

    }





}