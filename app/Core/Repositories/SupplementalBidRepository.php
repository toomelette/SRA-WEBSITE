<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SupplementalBidInterface;

use App\Models\SupplementalBid;


class SupplementalBidRepository extends BaseRepository implements SupplementalBidInterface {
	


    protected $supplemental_bid;



	public function __construct(SupplementalBid $supplemental_bid){

        $this->supplemental_bid = $supplemental_bid;
        parent::__construct();

    }





    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $supplemental_bids = $this->cache->remember('supplemental_bids:fetch:' . $key, 240, function() use ($request, $entries){

            $supplemental_bid = $this->supplemental_bid->newQuery();
            
            if(isset($request->q)){
                $this->search($supplemental_bid, $request->q);
            }

            return $this->populate($supplemental_bid, $entries);

        });

        return $supplemental_bids;

    }





    public function store($request, $file_location){

        $supplemental_bid = new SupplementalBid;
        $supplemental_bid->slug = $this->str->random(16);
        $supplemental_bid->supplemental_bid_id = $this->getSupplementalBidIdInc();
        $supplemental_bid->description = $request->description;
        $supplemental_bid->station = $this->__dataType->string_to_boolean($request->station);
        $supplemental_bid->date = $this->__dataType->date_parse($request->date);
        $supplemental_bid->file_location = $file_location;
        $supplemental_bid->created_at = $this->carbon->now();
        $supplemental_bid->updated_at = $this->carbon->now();
        $supplemental_bid->ip_created = request()->ip();
        $supplemental_bid->ip_updated = request()->ip();
        $supplemental_bid->user_created = $this->auth->user()->user_id;
        $supplemental_bid->user_updated = $this->auth->user()->user_id;
        $supplemental_bid->save();
        
        return $supplemental_bid;

    }





    public function update($request, $file_location, $supplemental_bid){
      
        $supplemental_bid->description = $request->description;
        $supplemental_bid->station = $this->__dataType->string_to_boolean($request->station);
        $supplemental_bid->date = $this->__dataType->date_parse($request->date);
        $supplemental_bid->file_location = $file_location;
        $supplemental_bid->updated_at = $this->carbon->now();
        $supplemental_bid->ip_updated = request()->ip();
        $supplemental_bid->user_updated = $this->auth->user()->user_id;
        $supplemental_bid->save();

        return $supplemental_bid;

    }





    public function destroy($supplemental_bid){

        $supplemental_bid->delete();
        return $supplemental_bid;

    }





    public function findBySlug($slug){

        $supplemental_bid = $this->cache->remember('supplemental_bids:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->supplemental_bid->where('slug', $slug)->first();
        }); 
        
        if(empty($supplemental_bid)){
            abort(404);
        }

        return $supplemental_bid;

    }






    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('description', 'LIKE', '%'. $key .'%');
        });

    }





    public function populate($model, $entries){

        return $model->select('file_location', 'description', 'station', 'date', 'slug')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate($entries);

    }






    public function getSupplementalBidIdInc(){

        $id = 'SB10001';

        $supplemental_bid = $this->supplemental_bid->select('supplemental_bid_id')->orderBy('supplemental_bid_id', 'desc')->first();

        if($supplemental_bid != null){

            if($supplemental_bid->supplemental_bid_id != null){
                $num = str_replace('SB', '', $supplemental_bid->supplemental_bid_id) + 1;
                $id = 'SB' . $num;
            }
        
        }
        
        return $id;
        
    }







}