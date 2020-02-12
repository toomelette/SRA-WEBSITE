<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\PlantersDirectoryInterface;

use App\Models\PlantersDirectory;


class PlantersDirectoryRepository extends BaseRepository implements PlantersDirectoryInterface {
	


    protected $planters_directory;



	public function __construct(PlantersDirectory $planters_directory){

        $this->planters_directory = $planters_directory;
        parent::__construct();

    }





    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $planters_directories = $this->cache->remember('planters_directories:fetch:' . $key, 240, function() use ($request, $entries){

            $planters_directory = $this->planters_directory->newQuery();
            
            if(isset($request->q)){
                $this->search($planters_directory, $request->q);
            }

            return $this->populate($planters_directory, $entries);

        });

        return $planters_directories;

    }





    public function store($request, $file_location){

        $planters_directory = new PlantersDirectory;
        $planters_directory->slug = $this->str->random(16);
        $planters_directory->planters_dir_id = $this->PlantersDirIdInc();
        $planters_directory->planters_dir_cat_id = $request->planters_dir_cat_id;
        $planters_directory->title = $request->title;
        $planters_directory->description = $request->description;
        $planters_directory->file_location = $file_location;
        $planters_directory->created_at = $this->carbon->now();
        $planters_directory->updated_at = $this->carbon->now();
        $planters_directory->ip_created = request()->ip();
        $planters_directory->ip_updated = request()->ip();
        $planters_directory->user_created = $this->auth->user()->user_id;
        $planters_directory->user_updated = $this->auth->user()->user_id;
        $planters_directory->save();
        
        return $planters_directory;

    }





    public function update($request, $file_location, $planters_directory){
        
        $planters_directory->planters_dir_cat_id = $request->planters_dir_cat_id;
        $planters_directory->title = $request->title;
        $planters_directory->description = $request->description;
        $planters_directory->file_location = $file_location;
        $planters_directory->updated_at = $this->carbon->now();
        $planters_directory->ip_updated = request()->ip();
        $planters_directory->user_updated = $this->auth->user()->user_id;
        $planters_directory->save();

        return $planters_directory;

    }





    public function destroy($planters_directory){

        $planters_directory->delete();
        return $planters_directory;

    }





    public function findBySlug($slug){

        $planters_directory = $this->cache->remember('planters_directories:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->planters_directory->where('slug', $slug)->first();
        }); 
        
        if(empty($planters_directory)){
            abort(404);
        }

        return $planters_directory;

    }






    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('title', 'LIKE', '%'. $key .'%')
                      ->orWhere('description', 'LIKE', '%'. $key .'%');
        });

    }





    public function populate($model, $entries){

        return $model->select('file_location', 'title', 'description', 'slug')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate($entries);

    }






    public function PlantersDirIdInc(){

        $id = 'PD10001';

        $planters_directory = $this->planters_directory->select('planters_dir_id')->orderBy('planters_dir_id', 'desc')->first();

        if($planters_directory != null){

            if($planters_directory->planters_dir_id != null){
                $num = str_replace('PD', '', $planters_directory->planters_dir_id) + 1;
                $id = 'PD' . $num;
            }
        
        }
        
        return $id;
        
    }






}