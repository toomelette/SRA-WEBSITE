<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\AdminCornerInterface;

use App\Models\AdminCorner;


class AdminCornerRepository extends BaseRepository implements AdminCornerInterface {
	


    protected $admin_corner;



	public function __construct(AdminCorner $admin_corner){

        $this->admin_corner = $admin_corner;
        parent::__construct();

    }





    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $admin_corners = $this->cache->remember('admin_corners:fetch:' . $key, 240, function() use ($request, $entries){

            $admin_corner = $this->admin_corner->newQuery();
            
            if(isset($request->q)){
                $this->search($admin_corner, $request->q);
            }

            return $this->populate($admin_corner, $entries);

        });

        return $admin_corners;

    }

        



    // public function guestFetch($request){

    //     $key = str_slug($request->fullUrl(), '_');

    //     $admin_corners = $this->cache->remember('admin_corners:guest:fetch:'. $key, 240, function(){
    //         $admin_corner = $this->admin_corner->newQuery();
    //         return $admin_corner->select('fullname', 'date_scope', 'img_location', 'slug')
    //                              ->orderBy('admin_corner_id', 'desc')
    //                              ->get();
    //     });

    //     return $admin_corners;

    // }





    public function store($request, $img_location){

        $admin_corner = new AdminCorner;
        $admin_corner->slug = $this->str->random(16);
        $admin_corner->admin_corner_id = $this->getAdminCornerIdInc();
        $admin_corner->type = (int)$request->type;
        $admin_corner->title = $request->title;
        $admin_corner->content = $request->content;
        $admin_corner->img_location = $img_location;
        $admin_corner->created_at = $this->carbon->now();
        $admin_corner->updated_at = $this->carbon->now();
        $admin_corner->ip_created = request()->ip();
        $admin_corner->ip_updated = request()->ip();
        $admin_corner->user_created = $this->auth->user()->user_id;
        $admin_corner->user_updated = $this->auth->user()->user_id;
        $admin_corner->save();
        
        return $admin_corner;

    }





    public function update($request, $img_location, $admin_corner){

        $admin_corner->type = (int)$request->type;
        $admin_corner->title = $request->title;
        $admin_corner->content = $request->content;
        $admin_corner->img_location = $img_location;
        $admin_corner->updated_at = $this->carbon->now();
        $admin_corner->ip_updated = request()->ip();
        $admin_corner->user_updated = $this->auth->user()->user_id;
        $admin_corner->save();

        return $admin_corner;

    }





    public function destroy($admin_corner){

        $admin_corner->delete();
        return $admin_corner;

    }





    public function findBySlug($slug){

        $admin_corner = $this->cache->remember('admin_corners:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->admin_corner->where('slug', $slug)->first();
        }); 
        
        if(empty($admin_corner)){
            abort(404);
        }

        return $admin_corner;

    }






    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('title', 'LIKE', '%'. $key .'%')
                      ->orWhere('content', 'LIKE', '%'. $key .'%');
        });

    }





    public function populate($model, $entries){

        return $model->select('img_location', 'type', 'title', 'slug')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate($entries);

    }






    public function getAdminCornerIdInc(){

        $id = 'AC10001';

        $admin_corner = $this->admin_corner->select('admin_corner_id')->orderBy('admin_corner_id', 'desc')->first();

        if($admin_corner != null){

            if($admin_corner->admin_corner_id != null){
                $num = str_replace('AC', '', $admin_corner->admin_corner_id) + 1;
                $id = 'AC' . $num;
            }
        
        }
        
        return $id;
        
    }






}