<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\AnnouncementInterface;

use App\Models\Announcement;


class AnnouncementRepository extends BaseRepository implements AnnouncementInterface {
	


    protected $announcement;



	public function __construct(Announcement $announcement){

        $this->announcement = $announcement;
        parent::__construct();

    }





    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $announcements = $this->cache->remember('announcements:fetch:' . $key, 240, function() use ($request, $entries){

            $announcement = $this->announcement->newQuery();
            
            if(isset($request->q)){
                $this->search($announcement, $request->q);
            }

            return $this->populate($announcement, $entries);

        });

        return $announcements;

    }





    public function store($request, $file_location){

        $announcement = new Announcement;
        $announcement->slug = $this->str->random(16);
        $announcement->announcement_id = $this->getAnnouncementIdInc();
        $announcement->type = $request->type;
        $announcement->file_location = $file_location;
        $announcement->url = $request->url;
        $announcement->title = $request->title;
        $announcement->content = $request->content;
        $announcement->created_at = $this->carbon->now();
        $announcement->updated_at = $this->carbon->now();
        $announcement->ip_created = request()->ip();
        $announcement->ip_updated = request()->ip();
        $announcement->user_created = $this->auth->user()->user_id;
        $announcement->user_updated = $this->auth->user()->user_id;
        $announcement->save();
        
        return $announcement;

    }





    public function update($request, $file_location, $announcement){

        $announcement->type = $request->type;
        $announcement->file_location = $file_location;
        $announcement->url = $request->url;
        $announcement->title = $request->title;
        $announcement->content = $request->content;
        $announcement->updated_at = $this->carbon->now();
        $announcement->ip_updated = request()->ip();
        $announcement->user_updated = $this->auth->user()->user_id;
        $announcement->save();

        return $announcement;

    }





    public function destroy($ann){

        $ann->delete();
        return $ann;

    }





    public function findBySlug($slug){

        $announcement = $this->cache->remember('announcements:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->announcement->where('slug', $slug)->first();
        }); 
        
        if(empty($announcement)){
            abort(404);
        }

        return $announcement;

    }






    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('title', 'LIKE', '%'. $key .'%')
                      ->orWhere('content', 'LIKE', '%'. $key .'%');
        });

    }





    public function populate($model, $entries){

        return $model->select('type', 'file_location', 'url', 'title', 'content', 'updated_at', 'slug')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate($entries);

    }






    public function getAnnouncementIdInc(){

        $id = 'ANN10001';

        $announcement = $this->announcement->select('announcement_id')->orderBy('announcement_id', 'desc')->first();

        if($announcement != null){

            if($announcement->announcement_id != null){
                $num = str_replace('ANN', '', $announcement->announcement_id) + 1;
                $id = 'ANN' . $num;
            }
        
        }
        
        return $id;
        
    }






}