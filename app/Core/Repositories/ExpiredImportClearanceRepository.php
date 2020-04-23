<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\ExpiredImportClearanceInterface;

use App\Models\ExpiredImportClearance;


class ExpiredImportClearanceRepository extends BaseRepository implements ExpiredImportClearanceInterface {
	


    protected $expired_import_clearance;



	public function __construct(ExpiredImportClearance $expired_import_clearance){

        $this->expired_import_clearance = $expired_import_clearance;
        parent::__construct();

    }





    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $expired_import_clearances = $this->cache->remember('expired_import_clearances:fetch:' . $key, 240, function() use ($request, $entries){

            $expired_import_clearance = $this->expired_import_clearance->newQuery();
            
            if(isset($request->q)){
                $this->search($expired_import_clearance, $request->q);
            }

            return $this->populate($expired_import_clearance, $entries);

        });

        return $expired_import_clearances;

    }





    public function guestFetch($request){

        $key = str_slug($request->fullUrl(), '_');

        $expired_import_clearances = $this->cache->remember('expired_import_clearances:guestFetch:' . $key, 240, function() use ($request){

            $entries = isset($request->e) ? $request->e : 20;

            $expired_import_clearance = $this->expired_import_clearance->newQuery();

            if(isset($request->q)){
                $expired_import_clearance->where('title', 'LIKE', '%'. $request->q .'%')
                                         ->orWhere('year', 'LIKE', '%'. $request->q .'%')
                                         ->orwhereHas('expiredImportClearanceCategory', function ($model) use ($request) {
                                            $model->where('name', 'LIKE', '%'. $request->q .'%');
                                         });
            }

            return $expired_import_clearance->select('file_location', 'title', 'expired_import_clearance_cat_id', 'year', 'slug')
                                            ->with('expiredImportClearanceCategory')
                                            ->sortable()
                                            ->orderBy('created_at', 'desc')
                                            ->paginate($entries);

        });

        return $expired_import_clearances;

    }





    public function store($request, $file_location){

        $expired_import_clearance = new ExpiredImportClearance;
        $expired_import_clearance->slug = $this->str->random(16);
        $expired_import_clearance->expired_import_clearance_id = $this->getExpiredImportClearanceIdInc();
        $expired_import_clearance->file_location = $file_location;
        $expired_import_clearance->expired_import_clearance_cat_id = $request->expired_import_clearance_cat_id;
        $expired_import_clearance->title = $request->title;
        $expired_import_clearance->year = $request->year;
        $expired_import_clearance->created_at = $this->carbon->now();
        $expired_import_clearance->updated_at = $this->carbon->now();
        $expired_import_clearance->ip_created = request()->ip();
        $expired_import_clearance->ip_updated = request()->ip();
        $expired_import_clearance->user_created = $this->auth->user()->user_id;
        $expired_import_clearance->user_updated = $this->auth->user()->user_id;
        $expired_import_clearance->save();
        
        return $expired_import_clearance;

    }





    public function update($request, $file_location, $expired_import_clearance){

        $expired_import_clearance->file_location = $file_location;
        $expired_import_clearance->expired_import_clearance_cat_id = $request->expired_import_clearance_cat_id;
        $expired_import_clearance->title = $request->title;
        $expired_import_clearance->year = $request->year;
        $expired_import_clearance->updated_at = $this->carbon->now();
        $expired_import_clearance->ip_updated = request()->ip();
        $expired_import_clearance->user_updated = $this->auth->user()->user_id;
        $expired_import_clearance->save();

        return $expired_import_clearance;

    }





    public function destroy($expired_import_clearance){

        $expired_import_clearance->delete();
        return $expired_import_clearance;

    }





    public function findBySlug($slug){

        $expired_import_clearance = $this->cache->remember('expired_import_clearances:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->expired_import_clearance->where('slug', $slug)->first();
        }); 
        
        if(empty($expired_import_clearance)){
            abort(404);
        }

        return $expired_import_clearance;

    }






    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('title', 'LIKE', '%'. $key .'%')
                      ->orWhere('year', 'LIKE', '%'. $key .'%')
                      ->orwhereHas('expiredImportClearanceCategory', function ($model) use ($key) {
                            $model->where('name', 'LIKE', '%'. $key .'%');
                        });
        });

    }





    public function populate($model, $entries){

        return $model->select('file_location', 'expired_import_clearance_cat_id', 'title', 'year', 'slug')
                     ->with('expiredImportClearanceCategory')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate($entries);

    }






    public function getExpiredImportClearanceIdInc(){

        $id = 'EIC10001';

        $expired_import_clearance = $this->expired_import_clearance->select('expired_import_clearance_id')->orderBy('expired_import_clearance_id', 'desc')->first();

        if($expired_import_clearance != null){

            if($expired_import_clearance->expired_import_clearance_id != null){
                $num = str_replace('EIC', '', $expired_import_clearance->expired_import_clearance_id) + 1;
                $id = 'EIC' . $num;
            }
        
        }
        
        return $id;
        
    }






}