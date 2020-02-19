<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\NoticeToProceedInterface;

use App\Models\NoticeToProceed;


class NoticeToProceedRepository extends BaseRepository implements NoticeToProceedInterface {
	


    protected $notice_to_proceed;



	public function __construct(NoticeToProceed $notice_to_proceed){

        $this->notice_to_proceed = $notice_to_proceed;
        parent::__construct();

    }





    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $notice_to_proceed = $this->cache->remember('notice_to_proceed:fetch:' . $key, 240, function() use ($request, $entries){

            $notice_to_proceed = $this->notice_to_proceed->newQuery();
            
            if(isset($request->q)){
                $this->search($notice_to_proceed, $request->q);
            }

            return $this->populate($notice_to_proceed, $entries);

        });

        return $notice_to_proceed;

    }





    public function store($request, $file_location_ntp, $file_location_po){

        $notice_to_proceed = new NoticeToProceed;
        $notice_to_proceed->slug = $this->str->random(16);
        $notice_to_proceed->notice_to_proceed_id = $this->getNoticeToProceedIdInc();
        $notice_to_proceed->description = $request->description;
        $notice_to_proceed->station = $this->__dataType->string_to_boolean($request->station);
        $notice_to_proceed->date = $this->__dataType->date_parse($request->date);
        $notice_to_proceed->file_location_ntp = $file_location_ntp;
        $notice_to_proceed->file_location_po = $file_location_po;
        $notice_to_proceed->created_at = $this->carbon->now();
        $notice_to_proceed->updated_at = $this->carbon->now();
        $notice_to_proceed->ip_created = request()->ip();
        $notice_to_proceed->ip_updated = request()->ip();
        $notice_to_proceed->user_created = $this->auth->user()->user_id;
        $notice_to_proceed->user_updated = $this->auth->user()->user_id;
        $notice_to_proceed->save();
        
        return $notice_to_proceed;

    }





    public function update($request, $file_location_ntp, $file_location_po, $notice_to_proceed){
      
        $notice_to_proceed->description = $request->description;
        $notice_to_proceed->station = $this->__dataType->string_to_boolean($request->station);
        $notice_to_proceed->date = $this->__dataType->date_parse($request->date);
        $notice_to_proceed->file_location_ntp = $file_location_ntp;
        $notice_to_proceed->file_location_po = $file_location_po;
        $notice_to_proceed->updated_at = $this->carbon->now();
        $notice_to_proceed->ip_updated = request()->ip();
        $notice_to_proceed->user_updated = $this->auth->user()->user_id;
        $notice_to_proceed->save();

        return $notice_to_proceed;

    }





    public function destroy($notice_to_proceed){

        $notice_to_proceed->delete();
        return $notice_to_proceed;

    }





    public function findBySlug($slug){

        $notice_to_proceed = $this->cache->remember('notice_to_proceed:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->notice_to_proceed->where('slug', $slug)->first();
        }); 
        
        if(empty($notice_to_proceed)){
            abort(404);
        }

        return $notice_to_proceed;

    }






    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('description', 'LIKE', '%'. $key .'%');
        });

    }





    public function populate($model, $entries){

        return $model->select('file_location_ntp', 'file_location_po', 'description', 'station', 'date', 'slug')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate($entries);

    }






    public function getNoticeToProceedIdInc(){

        $id = 'NTP10001';

        $notice_to_proceed = $this->notice_to_proceed->select('notice_to_proceed_id')->orderBy('notice_to_proceed_id', 'desc')->first();

        if($notice_to_proceed != null){

            if($notice_to_proceed->notice_to_proceed_id != null){
                $num = str_replace('NTP', '', $notice_to_proceed->notice_to_proceed_id) + 1;
                $id = 'NTP' . $num;
            }
        
        }
        
        return $id;
        
    }







}