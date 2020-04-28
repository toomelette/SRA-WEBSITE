<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SIDAFundUtilizationInterface;

use App\Models\SIDAFundUtilization;


class SIDAFundUtilizationRepository extends BaseRepository implements SIDAFundUtilizationInterface {
	


    protected $sida_fund_utilization;



	public function __construct(SIDAFundUtilization $sida_fund_utilization){

        $this->sida_fund_utilization = $sida_fund_utilization;
        parent::__construct();

    }





    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $sida_fund_utilizations = $this->cache->remember('sida_fund_utilizations:fetch:' . $key, 240, function() use ($request, $entries){

            $sida_fund_utilization = $this->sida_fund_utilization->newQuery();
            
            if(isset($request->q)){
                $this->search($sida_fund_utilization, $request->q);
            }

            return $this->populate($sida_fund_utilization, $entries);

        });

        return $sida_fund_utilizations;

    }





    public function guestFetch($request){

        $key = str_slug($request->fullUrl(), '_');

        $sida_fund_utilizations = $this->cache->remember('sida_fund_utilizations:guestFetch:' . $key, 240, function() use ($request){

            $entries = isset($request->e) ? $request->e : 20;

            $sida_fund_utilization = $this->sida_fund_utilization->newQuery();

            if(isset($request->q)){
                $sida_fund_utilization->where('title', 'LIKE', '%'. $request->q .'%')
                                      ->orWhere('description', 'LIKE', '%'. $request->q .'%');
            }

            return $sida_fund_utilization->select('file_location', 'title', 'description', 'slug')
                                         ->sortable()
                                         ->orderBy('created_at', 'desc')
                                         ->paginate($entries);

        });

        return $sida_fund_utilizations;

    }





    public function store($request, $file_location){

        $sida_fund_utilization = new SIDAFundUtilization;
        $sida_fund_utilization->slug = $this->str->random(16);
        $sida_fund_utilization->sida_fund_utilization_id = $this->getSidaFundUtilizationIdInc();
        $sida_fund_utilization->title = $request->title;
        $sida_fund_utilization->description = $request->description;
        $sida_fund_utilization->file_location = $file_location;
        $sida_fund_utilization->created_at = $this->carbon->now();
        $sida_fund_utilization->updated_at = $this->carbon->now();
        $sida_fund_utilization->ip_created = request()->ip();
        $sida_fund_utilization->ip_updated = request()->ip();
        $sida_fund_utilization->user_created = $this->auth->user()->user_id;
        $sida_fund_utilization->user_updated = $this->auth->user()->user_id;
        $sida_fund_utilization->save();
        
        return $sida_fund_utilization;

    }





    public function update($request, $file_location, $sida_fund_utilization){
  
        $sida_fund_utilization->title = $request->title;
        $sida_fund_utilization->description = $request->description;
        $sida_fund_utilization->file_location = $file_location;
        $sida_fund_utilization->updated_at = $this->carbon->now();
        $sida_fund_utilization->ip_updated = request()->ip();
        $sida_fund_utilization->user_updated = $this->auth->user()->user_id;
        $sida_fund_utilization->save();

        return $sida_fund_utilization;

    }





    public function destroy($sida_fund_utilization){

        $sida_fund_utilization->delete();
        return $sida_fund_utilization;

    }





    public function findBySlug($slug){

        $sida_fund_utilization = $this->cache->remember('sida_fund_utilizations:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->sida_fund_utilization->where('slug', $slug)->first();
        }); 
        
        if(empty($sida_fund_utilization)){
            abort(404);
        }

        return $sida_fund_utilization;

    }






    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('title', 'LIKE', '%'. $key .'%')
                      ->orwhere('description', 'LIKE', '%'. $key .'%');
        });

    }





    public function populate($model, $entries){

        return $model->select('file_location', 'title', 'description', 'slug')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate($entries);

    }






    public function getSidaFundUtilizationIdInc(){

        $id = 'SFU10001';

        $sida_fund_utilization = $this->sida_fund_utilization->select('sida_fund_utilization_id')->orderBy('sida_fund_utilization_id', 'desc')->first();

        if($sida_fund_utilization != null){

            if($sida_fund_utilization->sida_fund_utilization_id != null){
                $num = str_replace('SFU', '', $sida_fund_utilization->sida_fund_utilization_id) + 1;
                $id = 'SFU' . $num;
            }
        
        }
        
        return $id;
        
    }






}