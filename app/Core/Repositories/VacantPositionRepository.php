<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\VacantPositionInterface;

use App\Models\VacantPosition;


class VacantPositionRepository extends BaseRepository implements VacantPositionInterface {
	


    protected $vacant_position;



	public function __construct(VacantPosition $vacant_position){

        $this->vacant_position = $vacant_position;
        parent::__construct();

    }





    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $vacant_positions = $this->cache->remember('vacant_positions:fetch:' . $key, 240, function() use ($request, $entries){

            $vacant_position = $this->vacant_position->newQuery();
            
            if(isset($request->q)){
                $this->search($vacant_position, $request->q);
            }

            return $this->populate($vacant_position, $entries);

        });

        return $vacant_positions;

    }

        



    public function guestFetch($request){

        $key = str_slug($request->fullUrl(), '_');

        $vacant_positions = $this->cache->remember('vacant_positions:guest:fetch:'. $key, 240, function() use ($request){
                
            $entries = isset($request->e) ? $request->e : 20;

            $vacant_position = $this->vacant_position->newQuery();

            if(isset($request->q)){
                $vacant_position->where('title', 'LIKE', '%'. $request->q .'%');
            }

            return $vacant_position->select('file_location', 'title', 'slug')
                                   ->sortable()
                                   ->orderBy('updated_at', 'desc')
                                   ->paginate($entries);
        });

        return $vacant_positions;

    }





    public function store($request, $file_location){

        $vacant_position = new VacantPosition;
        $vacant_position->slug = $this->str->random(16);
        $vacant_position->vacant_position_id = $this->getVacantPositionIdInc();
        $vacant_position->title = $request->title;
        $vacant_position->file_location = $file_location;
        $vacant_position->created_at = $this->carbon->now();
        $vacant_position->updated_at = $this->carbon->now();
        $vacant_position->ip_created = request()->ip();
        $vacant_position->ip_updated = request()->ip();
        $vacant_position->user_created = $this->auth->user()->user_id;
        $vacant_position->user_updated = $this->auth->user()->user_id;
        $vacant_position->save();
        
        return $vacant_position;

    }





    public function update($request, $file_location, $vacant_position){

        $vacant_position->title = $request->title;
        $vacant_position->file_location = $file_location;
        $vacant_position->updated_at = $this->carbon->now();
        $vacant_position->ip_updated = request()->ip();
        $vacant_position->user_updated = $this->auth->user()->user_id;
        $vacant_position->save();

        return $vacant_position;

    }





    public function destroy($vacant_position){

        $vacant_position->delete();
        return $vacant_position;

    }





    public function findBySlug($slug){

        $vacant_position = $this->cache->remember('vacant_positions:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->vacant_position->where('slug', $slug)->first();
        }); 
        
        if(empty($vacant_position)){
            abort(404);
        }

        return $vacant_position;

    }






    public function search($model, $key){

        return $model->where('title', 'LIKE', '%'. $key .'%');

    }





    public function populate($model, $entries){

        return $model->select('file_location', 'title', 'slug')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate($entries);

    }






    public function getVacantPositionIdInc(){

        $id = 'VP10001';

        $vacant_position = $this->vacant_position->select('vacant_position_id')->orderBy('vacant_position_id', 'desc')->first();

        if($vacant_position != null){

            if($vacant_position->vacant_position_id != null){
                $num = str_replace('VP', '', $vacant_position->vacant_position_id) + 1;
                $id = 'VP' . $num;
            }
        
        }
        
        return $id;
        
    }






}