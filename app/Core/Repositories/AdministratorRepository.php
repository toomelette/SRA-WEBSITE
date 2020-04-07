<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\AdministratorInterface;

use App\Models\Administrator;


class AdministratorRepository extends BaseRepository implements AdministratorInterface {
	


    protected $administrator;



	public function __construct(Administrator $administrator){

        $this->administrator = $administrator;
        parent::__construct();

    }





    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $administrators = $this->cache->remember('administrators:fetch:' . $key, 240, function() use ($request, $entries){

            $administrator = $this->administrator->newQuery();
            
            if(isset($request->q)){
                $this->search($administrator, $request->q);
            }

            return $this->populate($administrator, $entries);

        });

        return $administrators;

    }

        



    public function guestfetch($request){

        $key = str_slug($request->fullUrl(), '_');

        $administrators = $this->cache->remember('administrators:guest:fetch:'. $key, 240, function(){
            $administrator = $this->administrator->newQuery();
            return $administrator->select('fullname', 'date_scope', 'file_location', 'slug')
                                 ->orderBy('administrator_id', 'desc')
                                 ->get();
        });

        return $administrators;

    }





    public function store($request, $file_location){

        $administrator = new Administrator;
        $administrator->slug = $this->str->random(16);
        $administrator->administrator_id = $this->getAdministratorIdInc();
        $administrator->fullname = $request->fullname;
        $administrator->date_scope = $request->date_scope;
        $administrator->file_location = $file_location;
        $administrator->created_at = $this->carbon->now();
        $administrator->updated_at = $this->carbon->now();
        $administrator->ip_created = request()->ip();
        $administrator->ip_updated = request()->ip();
        $administrator->user_created = $this->auth->user()->user_id;
        $administrator->user_updated = $this->auth->user()->user_id;
        $administrator->save();
        
        return $administrator;

    }





    public function update($request, $file_location, $administrator){

        $administrator->fullname = $request->fullname;
        $administrator->date_scope = $request->date_scope;
        $administrator->file_location = $file_location;
        $administrator->updated_at = $this->carbon->now();
        $administrator->ip_updated = request()->ip();
        $administrator->user_updated = $this->auth->user()->user_id;
        $administrator->save();

        return $administrator;

    }





    public function destroy($ann){

        $ann->delete();
        return $ann;

    }





    public function findBySlug($slug){

        $administrator = $this->cache->remember('administrators:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->administrator->where('slug', $slug)->first();
        }); 
        
        if(empty($administrator)){
            abort(404);
        }

        return $administrator;

    }






    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('fullname', 'LIKE', '%'. $key .'%');
        });

    }





    public function populate($model, $entries){

        return $model->select('file_location', 'fullname', 'date_scope', 'slug')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate($entries);

    }






    public function getAdministratorIdInc(){

        $id = 'ADM10001';

        $administrator = $this->administrator->select('administrator_id')->orderBy('administrator_id', 'desc')->first();

        if($administrator != null){

            if($administrator->administrator_id != null){
                $num = str_replace('ADM', '', $administrator->administrator_id) + 1;
                $id = 'ADM' . $num;
            }
        
        }
        
        return $id;
        
    }






}