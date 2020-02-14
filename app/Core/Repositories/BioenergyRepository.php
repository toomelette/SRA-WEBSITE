<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\BioenergyInterface;

use App\Models\Bioenergy;


class BioenergyRepository extends BaseRepository implements BioenergyInterface {
	


    protected $bioenergy;



	public function __construct(Bioenergy $bioenergy){

        $this->bioenergy = $bioenergy;
        parent::__construct();

    }





    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $bioenergys = $this->cache->remember('bioenergy:fetch:' . $key, 240, function() use ($request, $entries){

            $bioenergy = $this->bioenergy->newQuery();
            
            if(isset($request->q)){
                $this->search($bioenergy, $request->q);
            }

            return $this->populate($bioenergy, $entries);

        });

        return $bioenergys;

    }





    public function store($request, $file_location){

        $bioenergy = new Bioenergy;
        $bioenergy->slug = $this->str->random(16);
        $bioenergy->bioenergy_id = $this->getBioenergyIdInc();
        $bioenergy->title = $request->title;
        $bioenergy->file_location = $file_location;
        $bioenergy->created_at = $this->carbon->now();
        $bioenergy->updated_at = $this->carbon->now();
        $bioenergy->ip_created = request()->ip();
        $bioenergy->ip_updated = request()->ip();
        $bioenergy->user_created = $this->auth->user()->user_id;
        $bioenergy->user_updated = $this->auth->user()->user_id;
        $bioenergy->save();
        
        return $bioenergy;

    }





    public function update($request, $file_location, $bioenergy){

        $bioenergy->title = $request->title;
        $bioenergy->file_location = $file_location;
        $bioenergy->updated_at = $this->carbon->now();
        $bioenergy->ip_updated = request()->ip();
        $bioenergy->user_updated = $this->auth->user()->user_id;
        $bioenergy->save();

        return $bioenergy;

    }





    public function destroy($bioenergy){

        $bioenergy->delete();
        return $bioenergy;

    }





    public function findBySlug($slug){

        $bioenergy = $this->cache->remember('bioenergy:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->bioenergy->where('slug', $slug)->first();
        }); 
        
        if(empty($bioenergy)){
            abort(404);
        }

        return $bioenergy;

    }






    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('title', 'LIKE', '%'. $key .'%');
        });

    }





    public function populate($model, $entries){

        return $model->select('file_location', 'title', 'slug')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate($entries);

    }






    public function getBioenergyIdInc(){

        $id = 'B10001';

        $bioenergy = $this->bioenergy->select('bioenergy_id')->orderBy('bioenergy_id', 'desc')->first();

        if($bioenergy != null){

            if($bioenergy->bioenergy_id != null){
                $num = str_replace('B', '', $bioenergy->bioenergy_id) + 1;
                $id = 'B' . $num;
            }
        
        }
        
        return $id;
        
    }






}