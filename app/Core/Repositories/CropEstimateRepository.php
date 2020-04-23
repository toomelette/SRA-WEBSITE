<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\CropEstimateInterface;

use App\Models\CropEstimate;


class CropEstimateRepository extends BaseRepository implements CropEstimateInterface {
	


    protected $crop_estimate;



	public function __construct(CropEstimate $crop_estimate){

        $this->crop_estimate = $crop_estimate;
        parent::__construct();

    }





    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $crop_estimates = $this->cache->remember('crop_estimates:fetch:' . $key, 240, function() use ($request, $entries){

            $crop_estimate = $this->crop_estimate->newQuery();
            
            if(isset($request->q)){
                $this->search($crop_estimate, $request->q);
            }

            return $this->populate($crop_estimate, $entries);

        });

        return $crop_estimates;

    }





    public function guestFetch($request){

        $key = str_slug($request->fullUrl(), '_');

        $crop_estimates = $this->cache->remember('crop_estimates:guestFetch:' . $key, 240, function() use ($request){

            $entries = isset($request->e) ? $request->e : 20;

            $crop_estimate = $this->crop_estimate->newQuery();

            if(isset($request->q)){
                $crop_estimate->where('title', 'LIKE', '%'. $request->q .'%');
            }

            return $crop_estimate->select('file_location', 'title', 'slug')
                                 ->sortable()
                                 ->orderBy('created_at', 'desc')
                                 ->paginate($entries);

        });

        return $crop_estimates;

    }





    public function store($request, $file_location){

        $crop_estimate = new CropEstimate;
        $crop_estimate->slug = $this->str->random(16);
        $crop_estimate->crop_estimate_id = $this->getCropEstimateIdInc();
        $crop_estimate->title = $request->title;
        $crop_estimate->file_location = $file_location;
        $crop_estimate->created_at = $this->carbon->now();
        $crop_estimate->updated_at = $this->carbon->now();
        $crop_estimate->ip_created = request()->ip();
        $crop_estimate->ip_updated = request()->ip();
        $crop_estimate->user_created = $this->auth->user()->user_id;
        $crop_estimate->user_updated = $this->auth->user()->user_id;
        $crop_estimate->save();
        
        return $crop_estimate;

    }





    public function update($request, $file_location, $crop_estimate){

        $crop_estimate->title = $request->title;
        $crop_estimate->file_location = $file_location;
        $crop_estimate->updated_at = $this->carbon->now();
        $crop_estimate->ip_updated = request()->ip();
        $crop_estimate->user_updated = $this->auth->user()->user_id;
        $crop_estimate->save();

        return $crop_estimate;

    }





    public function destroy($crop_estimate){

        $crop_estimate->delete();
        return $crop_estimate;

    }





    public function findBySlug($slug){

        $crop_estimate = $this->cache->remember('crop_estimates:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->crop_estimate->where('slug', $slug)->first();
        }); 
        
        if(empty($crop_estimate)){
            abort(404);
        }

        return $crop_estimate;

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






    public function getCropEstimateIdInc(){

        $id = 'SP10001';

        $crop_estimate = $this->crop_estimate->select('crop_estimate_id')->orderBy('crop_estimate_id', 'desc')->first();

        if($crop_estimate != null){

            if($crop_estimate->crop_estimate_id != null){
                $num = str_replace('SP', '', $crop_estimate->crop_estimate_id) + 1;
                $id = 'SP' . $num;
            }
        
        }
        
        return $id;
        
    }






}