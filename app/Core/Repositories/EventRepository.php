<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\EventInterface;

use App\Models\Event;


class EventRepository extends BaseRepository implements EventInterface {
	


    protected $event;



	public function __construct(Event $event){

        $this->event = $event;
        parent::__construct();

    }





    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $events = $this->cache->remember('events:fetch:' . $key, 240, function() use ($request, $entries){

            $event = $this->event->newQuery();
            
            if(isset($request->q)){
                $this->search($event, $request->q);
            }

            return $this->populate($event, $entries);

        });

        return $events;

    }





    public function store($request, $file_location){

        $event = new Event;
        $event->slug = $this->str->random(16);
        $event->event_id = $this->getEventIdInc();
        $event->station_id = $request->station_id;
        $event->title = $request->title;
        $event->description = $request->description;
        $event->file_location = $file_location;
        $event->date_from = $this->__dataType->date_parse($request->date_from);
        $event->date_to = $this->__dataType->date_parse($request->date_to);
        $event->created_at = $this->carbon->now();
        $event->updated_at = $this->carbon->now();
        $event->ip_created = request()->ip();
        $event->ip_updated = request()->ip();
        $event->user_created = $this->auth->user()->user_id;
        $event->user_updated = $this->auth->user()->user_id;
        $event->save();
        
        return $event;

    }





    public function update($request, $file_location, $event){

        $event->station_id = $request->station_id;
        $event->title = $request->title;
        $event->description = $request->description;
        $event->file_location = $file_location;
        $event->date_from = $this->__dataType->date_parse($request->date_from);
        $event->date_to = $this->__dataType->date_parse($request->date_to);
        $event->updated_at = $this->carbon->now();
        $event->ip_updated = request()->ip();
        $event->user_updated = $this->auth->user()->user_id;
        $event->save();

        return $event;

    }





    public function destroy($event){

        $event->delete();
        return $event;

    }





    public function findBySlug($slug){

        $event = $this->cache->remember('events:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->event->where('slug', $slug)->first();
        }); 
        
        if(empty($event)){
            abort(404);
        }

        return $event;

    }






    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('title', 'LIKE', '%'. $key .'%')
                      ->orWhere('description', 'LIKE', '%'. $key .'%') ;
        });

    }





    public function populate($model, $entries){

        return $model->select('file_location', 'station_id', 'description', 'title', 'date_from', 'date_to', 'slug')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate($entries);

    }






    public function getEventIdInc(){

        $id = 'E10001';

        $event = $this->event->select('event_id')->orderBy('event_id', 'desc')->first();

        if($event != null){

            if($event->event_id != null){
                $num = str_replace('E', '', $event->event_id) + 1;
                $id = 'E' . $num;
            }
        
        }
        
        return $id;
        
    }






}