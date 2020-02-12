<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\TradersDirectoryInterface;

use App\Models\TradersDirectory;


class TradersDirectoryRepository extends BaseRepository implements TradersDirectoryInterface {
	


    protected $traders_directory;



	public function __construct(TradersDirectory $traders_directory){

        $this->traders_directory = $traders_directory;
        parent::__construct();

    }





    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $traders_directories = $this->cache->remember('traders_directories:fetch:' . $key, 240, function() use ($request, $entries){

            $traders_directory = $this->traders_directory->newQuery();
            
            if(isset($request->q)){
                $this->search($traders_directory, $request->q);
            }

            return $this->populate($traders_directory, $entries);

        });

        return $traders_directories;

    }





    public function store($request, $file_location){

        $traders_directory = new TradersDirectory;
        $traders_directory->slug = $this->str->random(16);
        $traders_directory->traders_dir_id = $this->getTradersDirIdInc();
        $traders_directory->traders_dir_cat_id = $request->traders_dir_cat_id;
        $traders_directory->title = $request->title;
        $traders_directory->description = $request->description;
        $traders_directory->file_location = $file_location;
        $traders_directory->created_at = $this->carbon->now();
        $traders_directory->updated_at = $this->carbon->now();
        $traders_directory->ip_created = request()->ip();
        $traders_directory->ip_updated = request()->ip();
        $traders_directory->user_created = $this->auth->user()->user_id;
        $traders_directory->user_updated = $this->auth->user()->user_id;
        $traders_directory->save();
        
        return $traders_directory;

    }





    public function update($request, $file_location, $traders_directory){
        
        $traders_directory->traders_dir_cat_id = $request->traders_dir_cat_id;
        $traders_directory->title = $request->title;
        $traders_directory->description = $request->description;
        $traders_directory->file_location = $file_location;
        $traders_directory->updated_at = $this->carbon->now();
        $traders_directory->ip_updated = request()->ip();
        $traders_directory->user_updated = $this->auth->user()->user_id;
        $traders_directory->save();

        return $traders_directory;

    }





    public function destroy($traders_directory){

        $traders_directory->delete();
        return $traders_directory;

    }





    public function findBySlug($slug){

        $traders_directory = $this->cache->remember('traders_directories:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->traders_directory->where('slug', $slug)->first();
        }); 
        
        if(empty($traders_directory)){
            abort(404);
        }

        return $traders_directory;

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






    public function getTradersDirIdInc(){

        $id = 'TD10001';

        $traders_directory = $this->traders_directory->select('traders_dir_id')->orderBy('traders_dir_id', 'desc')->first();

        if($traders_directory != null){

            if($traders_directory->traders_dir_id != null){
                $num = str_replace('TD', '', $traders_directory->traders_dir_id) + 1;
                $id = 'TD' . $num;
            }
        
        }
        
        return $id;
        
    }






}