<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\OfficialInterface;

use App\Models\Official;


class OfficialRepository extends BaseRepository implements OfficialInterface {
    


    protected $official;



    public function __construct(Official $official){

        $this->official = $official;
        parent::__construct();

    }





    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $official = $this->cache->remember('officials:fetch:' . $key, 240, function() use ($request, $entries){

            $official = $this->official->newQuery();
            
            if(isset($request->q)){
                $this->search($official, $request->q);
            }

            return $this->populate($official, $entries);

        });

        return $official;

    }

        



    public function guestfetch($request){

        $key = str_slug($request->fullUrl(), '_');

        $officials = $this->cache->remember('officials:guest:fetch:'. $key, 240, function(){
            $official = $this->official->newQuery();
            return $official->select('office_id', 'station_id', 'fullname', 'position', 'email', 'contact_no', 'file_location', 'slug')
                            ->with('office', 'station')
                            ->get();
        });

        return $officials;

    }





    public function store($request, $file_location){

        $official = new Official;
        $official->slug = $this->str->random(16);
        $official->official_id = $this->getOfficialIdInc();
        $official->office_id = $request->office_id;
        $official->station_id = $request->station_id;
        $official->fullname = $request->fullname;
        $official->position = $request->position;
        $official->email = $request->email;
        $official->contact_no = $request->contact_no;
        $official->file_location = $file_location;
        $official->created_at = $this->carbon->now();
        $official->updated_at = $this->carbon->now();
        $official->ip_created = request()->ip();
        $official->ip_updated = request()->ip();
        $official->user_created = $this->auth->user()->user_id;
        $official->user_updated = $this->auth->user()->user_id;
        $official->save();
        
        return $official;

    }





    public function update($request, $file_location, $official){

        $official->office_id = $request->office_id;
        $official->station_id = $request->station_id;
        $official->fullname = $request->fullname;
        $official->position = $request->position;
        $official->email = $request->email;
        $official->contact_no = $request->contact_no;
        $official->file_location = $file_location;
        $official->updated_at = $this->carbon->now();
        $official->ip_updated = request()->ip();
        $official->user_updated = $this->auth->user()->user_id;
        $official->save();

        return $official;

    }





    public function destroy($official){

        $official->delete();
        return $official;

    }





    public function findBySlug($slug){

        $official = $this->cache->remember('officials:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->official->where('slug', $slug)->first();
        }); 
        
        if(empty($official)){abort(404);}

        return $official;

    }






    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('fullname', 'LIKE', '%'. $key .'%')
                      ->orWhere('email', 'LIKE', '%'. $key .'%')
                      ->orWhere('contact_no', 'LIKE', '%'. $key .'%')
                      ->orwhereHas('office', function ($model) use ($key) {
                            $model->where('name', 'LIKE', '%'. $key .'%');
                        })
                      ->orwhereHas('station', function ($model) use ($key) {
                            $model->where('name', 'LIKE', '%'. $key .'%');
                        });
        });

    }





    public function populate($model, $entries){

        return $model->select('file_location', 'fullname', 'office_id', 'station_id', 'email', 'contact_no', 'slug')
                     ->with('office', 'station')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate($entries);

    }






    public function getOfficialIdInc(){

        $id = 'OFCL10001';

        $official = $this->official->select('official_id')->orderBy('official_id', 'desc')->first();

        if($official != null){

            if($official->official_id != null){
                $num = str_replace('OFCL', '', $official->official_id) + 1;
                $id = 'OFCL' . $num;
            }
        
        }
        
        return $id;
        
    }






}