<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\MillingScheduleInterface;

use App\Models\MillingSchedule;


class MillingScheduleRepository extends BaseRepository implements MillingScheduleInterface {
	


    protected $milling_schedule;



	public function __construct(MillingSchedule $milling_schedule){

        $this->milling_schedule = $milling_schedule;
        parent::__construct();

    }





    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $milling_schedules = $this->cache->remember('milling_schedules:fetch:' . $key, 240, function() use ($request, $entries){

            $milling_schedule = $this->milling_schedule->newQuery();
            
            if(isset($request->q)){
                $this->search($milling_schedule, $request->q);
            }

            return $this->populate($milling_schedule, $entries);

        });

        return $milling_schedules;

    }





    public function store($request, $file_location){

        $milling_schedule = new MillingSchedule;
        $milling_schedule->slug = $this->str->random(16);
        $milling_schedule->milling_schedule_id = $this->getMillingScheduleIdInc();
        $milling_schedule->title = $request->title;
        $milling_schedule->file_location = $file_location;
        $milling_schedule->created_at = $this->carbon->now();
        $milling_schedule->updated_at = $this->carbon->now();
        $milling_schedule->ip_created = request()->ip();
        $milling_schedule->ip_updated = request()->ip();
        $milling_schedule->user_created = $this->auth->user()->user_id;
        $milling_schedule->user_updated = $this->auth->user()->user_id;
        $milling_schedule->save();
        
        return $milling_schedule;

    }





    public function update($request, $file_location, $milling_schedule){

        $milling_schedule->title = $request->title;
        $milling_schedule->file_location = $file_location;
        $milling_schedule->updated_at = $this->carbon->now();
        $milling_schedule->ip_updated = request()->ip();
        $milling_schedule->user_updated = $this->auth->user()->user_id;
        $milling_schedule->save();

        return $milling_schedule;

    }





    public function destroy($milling_schedule){

        $milling_schedule->delete();
        return $milling_schedule;

    }





    public function findBySlug($slug){

        $milling_schedule = $this->cache->remember('milling_schedules:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->milling_schedule->where('slug', $slug)->first();
        }); 
        
        if(empty($milling_schedule)){
            abort(404);
        }

        return $milling_schedule;

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






    public function getMillingScheduleIdInc(){

        $id = 'MS10001';

        $milling_schedule = $this->milling_schedule->select('milling_schedule_id')->orderBy('milling_schedule_id', 'desc')->first();

        if($milling_schedule != null){

            if($milling_schedule->milling_schedule_id != null){
                $num = str_replace('MS', '', $milling_schedule->milling_schedule_id) + 1;
                $id = 'MS' . $num;
            }
        
        }
        
        return $id;
        
    }






}