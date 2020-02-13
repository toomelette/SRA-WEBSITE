<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\PolicyInterface;

use App\Models\Policy;


class PolicyRepository extends BaseRepository implements PolicyInterface {
	


    protected $policy;



	public function __construct(Policy $policy){

        $this->policy = $policy;
        parent::__construct();

    }





    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $policies = $this->cache->remember('policies:fetch:' . $key, 240, function() use ($request, $entries){

            $policy = $this->policy->newQuery();
            
            if(isset($request->q)){
                $this->search($policy, $request->q);
            }

            return $this->populate($policy, $entries);

        });

        return $policies;

    }





    public function store($request, $file_location){

        $policy = new Policy;
        $policy->slug = $this->str->random(16);
        $policy->policy_id = $this->getPolicyIdInc();
        $policy->crop_year_id = $request->crop_year_id;
        $policy->policy_category_id = $request->policy_category_id;
        $policy->title = $request->title;
        $policy->file_location = $file_location;
        $policy->created_at = $this->carbon->now();
        $policy->updated_at = $this->carbon->now();
        $policy->ip_created = request()->ip();
        $policy->ip_updated = request()->ip();
        $policy->user_created = $this->auth->user()->user_id;
        $policy->user_updated = $this->auth->user()->user_id;
        $policy->save();
        
        return $policy;

    }





    public function update($request, $file_location, $policy){

        $policy->crop_year_id = $request->crop_year_id;
        $policy->policy_category_id = $request->policy_category_id;
        $policy->title = $request->title;
        $policy->file_location = $file_location;
        $policy->updated_at = $this->carbon->now();
        $policy->ip_updated = request()->ip();
        $policy->user_updated = $this->auth->user()->user_id;
        $policy->save();

        return $policy;

    }





    public function destroy($policy){

        $policy->delete();
        return $policy;

    }





    public function findBySlug($slug){

        $policy = $this->cache->remember('policies:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->policy->where('slug', $slug)->first();
        }); 
        
        if(empty($policy)){
            abort(404);
        }

        return $policy;

    }






    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('title', 'LIKE', '%'. $key .'%')
                      ->orwhereHas('policyCategory', function ($model) use ($key) {
                            $model->where('name', 'LIKE', '%'. $key .'%');
                        })
                      ->orwhereHas('cropYear', function ($model) use ($key) {
                            $model->where('name', 'LIKE', '%'. $key .'%');
                        });
        });

    }





    public function populate($model, $entries){

        return $model->select('file_location', 'crop_year_id', 'policy_category_id', 'title', 'slug')
                     ->with('cropYear', 'policyCategory')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate($entries);

    }






    public function getPolicyIdInc(){

        $id = 'P10001';

        $policy = $this->policy->select('policy_id')->orderBy('policy_id', 'desc')->first();

        if($policy != null){

            if($policy->policy_id != null){
                $num = str_replace('P', '', $policy->policy_id) + 1;
                $id = 'P' . $num;
            }
        
        }
        
        return $id;
        
    }






}