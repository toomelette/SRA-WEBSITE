<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\MinutesOfTheBidInterface;

use App\Models\MinutesOfTheBid;


class MinutesOfTheBidRepository extends BaseRepository implements MinutesOfTheBidInterface {
	


    protected $minutes_of_the_bid;



	public function __construct(MinutesOfTheBid $minutes_of_the_bid){

        $this->minutes_of_the_bid = $minutes_of_the_bid;
        parent::__construct();

    }





    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $minutes_of_the_bid = $this->cache->remember('minutes_of_the_bid:fetch:' . $key, 240, function() use ($request, $entries){

            $minutes_of_the_bid = $this->minutes_of_the_bid->newQuery();
            
            if(isset($request->q)){
                $this->search($minutes_of_the_bid, $request->q);
            }

            return $this->populate($minutes_of_the_bid, $entries);

        });

        return $minutes_of_the_bid;

    }





    public function guestFetch($request){

        $key = str_slug($request->fullUrl(), '_');

        $minutes_of_the_bid = $this->cache->remember('minutes_of_the_bid:guestFetch:' . $key, 240, function() use ($request){

            $entries = isset($request->e) ? $request->e : 20;

            $minutes_of_the_bid = $this->minutes_of_the_bid->newQuery();

            if(isset($request->q)){
                $minutes_of_the_bid->where('title', 'LIKE', '%'. $request->q .'%')
                                   ->orWhere('location', 'LIKE', '%'. $request->q .'%');
            }

            return $minutes_of_the_bid->select('file_location', 'title', 'location', 'date', 'slug')
                                      ->sortable()
                                      ->orderBy('created_at', 'desc')
                                      ->paginate($entries);

        });

        return $minutes_of_the_bid;

    }





    public function store($request, $file_location){

        $minutes_of_the_bid = new MinutesOfTheBid;
        $minutes_of_the_bid->slug = $this->str->random(16);
        $minutes_of_the_bid->motb_id = $this->getMotbIdInc();
        $minutes_of_the_bid->title = $request->title;
        $minutes_of_the_bid->location = $request->location;
        $minutes_of_the_bid->date = $this->__dataType->date_parse($request->date);
        $minutes_of_the_bid->file_location = $file_location;
        $minutes_of_the_bid->created_at = $this->carbon->now();
        $minutes_of_the_bid->updated_at = $this->carbon->now();
        $minutes_of_the_bid->ip_created = request()->ip();
        $minutes_of_the_bid->ip_updated = request()->ip();
        $minutes_of_the_bid->user_created = $this->auth->user()->user_id;
        $minutes_of_the_bid->user_updated = $this->auth->user()->user_id;
        $minutes_of_the_bid->save();
        
        return $minutes_of_the_bid;

    }





    public function update($request, $file_location, $minutes_of_the_bid){
      
        $minutes_of_the_bid->title = $request->title;
        $minutes_of_the_bid->location = $request->location;
        $minutes_of_the_bid->date = $this->__dataType->date_parse($request->date);
        $minutes_of_the_bid->file_location = $file_location;
        $minutes_of_the_bid->updated_at = $this->carbon->now();
        $minutes_of_the_bid->ip_updated = request()->ip();
        $minutes_of_the_bid->user_updated = $this->auth->user()->user_id;
        $minutes_of_the_bid->save();

        return $minutes_of_the_bid;

    }





    public function destroy($minutes_of_the_bid){

        $minutes_of_the_bid->delete();
        return $minutes_of_the_bid;

    }





    public function findBySlug($slug){

        $minutes_of_the_bid = $this->cache->remember('minutes_of_the_bid:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->minutes_of_the_bid->where('slug', $slug)->first();
        }); 
        
        if(empty($minutes_of_the_bid)){
            abort(404);
        }

        return $minutes_of_the_bid;

    }






    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('title', 'LIKE', '%'. $key .'%')
                      ->orWhere('location', 'LIKE', '%'. $key .'%');
        });

    }





    public function populate($model, $entries){

        return $model->select('file_location', 'title', 'location', 'date', 'slug')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate($entries);

    }






    public function getMotbIdInc(){

        $id = 'MOTB10001';

        $minutes_of_the_bid = $this->minutes_of_the_bid->select('motb_id')->orderBy('motb_id', 'desc')->first();

        if($minutes_of_the_bid != null){

            if($minutes_of_the_bid->motb_id != null){
                $num = str_replace('MOTB', '', $minutes_of_the_bid->motb_id) + 1;
                $id = 'MOTB' . $num;
            }
        
        }
        
        return $id;
        
    }







}