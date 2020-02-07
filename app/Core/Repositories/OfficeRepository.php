<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\OfficeInterface;

use App\Models\Office;


class OfficeRepository extends BaseRepository implements OfficeInterface {
	


    protected $office;



	public function __construct(Office $office){

        $this->office = $office;
        parent::__construct();

    }





    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $offices = $this->cache->remember('offices:fetch:' . $key, 240, function() use ($request, $entries){

            $office = $this->office->newQuery();
            
            if(isset($request->q)){
                $this->search($office, $request->q);
            }

            return $this->populate($office, $entries);

        });

        return $offices;

    }





    public function store($request){

        $office = new Office;
        $office->office_id = $this->getOfficeIdInc();
        $office->slug = $this->str->random(16);
        $office->seq_no = $request->seq_no;
        $office->name = $request->name;
        $office->created_at = $this->carbon->now();
        $office->updated_at = $this->carbon->now();
        $office->ip_created = request()->ip();
        $office->ip_updated = request()->ip();
        $office->user_created = $this->auth->user()->user_id;
        $office->user_updated = $this->auth->user()->user_id;
        $office->save();
        
        return $office;

    }





    public function update($request, $slug){

        $office = $this->findBySlug($slug);
        $office->seq_no = $request->seq_no;
        $office->name = $request->name;
        $office->updated_at = $this->carbon->now();
        $office->ip_updated = request()->ip();
        $office->user_updated = $this->auth->user()->user_id;
        $office->save();
        $office->save();
        
        return $office;

    }





    public function destroy($slug){

        $office = $this->findBySlug($slug);
        $office->delete();

        return $office;

    }





    public function findBySlug($slug){

        $office = $this->cache->remember('offices:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->office->where('slug', $slug)->first();
        }); 
        
        if(empty($office)){
            abort(404);
        }

        return $office;

    }






    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('name', 'LIKE', '%'. $key .'%');
        });

    }





    public function populate($model, $entries){

        return $model->select('seq_no', 'name', 'slug')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate($entries);

    }






    public function getOfficeIdInc(){

        $id = 'O10001';

        $office = $this->office->select('office_id')->orderBy('office_id', 'desc')->first();

        if($office != null){

            if($office->office_id != null){
                $num = str_replace('O', '', $office->office_id) + 1;
                $id = 'O' . $num;
            }
        
        }
        
        return $id;
        
    }





    public function getAll(){

        $offices = $this->cache->remember('offices:getAll', 240, function(){
            return $this->office->select('office_id', 'name')
                                 ->get();
        });
        
        return $offices;

    }







}