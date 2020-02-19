<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\NoticeOfAwardInterface;

use App\Models\NoticeOfAward;


class NoticeOfAwardRepository extends BaseRepository implements NoticeOfAwardInterface {
	


    protected $notice_of_award;



	public function __construct(NoticeOfAward $notice_of_award){

        $this->notice_of_award = $notice_of_award;
        parent::__construct();

    }





    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $notice_of_award = $this->cache->remember('notice_of_award:fetch:' . $key, 240, function() use ($request, $entries){

            $notice_of_award = $this->notice_of_award->newQuery();
            
            if(isset($request->q)){
                $this->search($notice_of_award, $request->q);
            }

            return $this->populate($notice_of_award, $entries);

        });

        return $notice_of_award;

    }





    public function store($request, $file_location_noa, $file_location_bacreso){

        $notice_of_award = new NoticeOfAward;
        $notice_of_award->slug = $this->str->random(16);
        $notice_of_award->notice_of_award_id = $this->getNoticeOfAwardIdInc();
        $notice_of_award->description = $request->description;
        $notice_of_award->station = $this->__dataType->string_to_boolean($request->station);
        $notice_of_award->date = $this->__dataType->date_parse($request->date);
        $notice_of_award->file_location_noa = $file_location_noa;
        $notice_of_award->file_location_bacreso = $file_location_bacreso;
        $notice_of_award->created_at = $this->carbon->now();
        $notice_of_award->updated_at = $this->carbon->now();
        $notice_of_award->ip_created = request()->ip();
        $notice_of_award->ip_updated = request()->ip();
        $notice_of_award->user_created = $this->auth->user()->user_id;
        $notice_of_award->user_updated = $this->auth->user()->user_id;
        $notice_of_award->save();
        
        return $notice_of_award;

    }





    public function update($request, $file_location_noa, $file_location_bacreso, $notice_of_award){
      
        $notice_of_award->description = $request->description;
        $notice_of_award->station = $this->__dataType->string_to_boolean($request->station);
        $notice_of_award->date = $this->__dataType->date_parse($request->date);
        $notice_of_award->file_location_noa = $file_location_noa;
        $notice_of_award->file_location_bacreso = $file_location_bacreso;
        $notice_of_award->updated_at = $this->carbon->now();
        $notice_of_award->ip_updated = request()->ip();
        $notice_of_award->user_updated = $this->auth->user()->user_id;
        $notice_of_award->save();

        return $notice_of_award;

    }





    public function destroy($notice_of_award){

        $notice_of_award->delete();
        return $notice_of_award;

    }





    public function findBySlug($slug){

        $notice_of_award = $this->cache->remember('notice_of_award:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->notice_of_award->where('slug', $slug)->first();
        }); 
        
        if(empty($notice_of_award)){
            abort(404);
        }

        return $notice_of_award;

    }






    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('description', 'LIKE', '%'. $key .'%');
        });

    }





    public function populate($model, $entries){

        return $model->select('file_location_noa', 'file_location_bacreso', 'description', 'station', 'date', 'slug')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate($entries);

    }






    public function getNoticeOfAwardIdInc(){

        $id = 'NOA10001';

        $notice_of_award = $this->notice_of_award->select('notice_of_award_id')->orderBy('notice_of_award_id', 'desc')->first();

        if($notice_of_award != null){

            if($notice_of_award->notice_of_award_id != null){
                $num = str_replace('NOA', '', $notice_of_award->notice_of_award_id) + 1;
                $id = 'NOA' . $num;
            }
        
        }
        
        return $id;
        
    }







}