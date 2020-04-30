<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\HistoricalDataInterface;

use App\Models\HistoricalData;


class HistoricalDataRepository extends BaseRepository implements HistoricalDataInterface {
	


    protected $historical_data;



	public function __construct(HistoricalData $historical_data){

        $this->historical_data = $historical_data;
        parent::__construct();

    }





    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $historical_datas = $this->cache->remember('historical_datas:fetch:' . $key, 240, function() use ($request, $entries){

            $historical_data = $this->historical_data->newQuery();
            
            if(isset($request->q)){
                $this->search($historical_data, $request->q);
            }

            return $this->populate($historical_data, $entries);

        });

        return $historical_datas;

    }

        



    public function guestFetch($request){

        $key = str_slug($request->fullUrl(), '_');

        $historical_datas = $this->cache->remember('historical_datas:guest:fetch:'. $key, 240, function() use ($request){
                
            $entries = isset($request->e) ? $request->e : 20;

            $historical_data = $this->historical_data->newQuery();

            if(isset($request->q)){
                $historical_data->where('title', 'LIKE', '%'. $request->q .'%')
                                ->orWhereYear('date_from', 'LIKE', '%'. $request->q .'%')
                                ->orWhereYear('date_to', 'LIKE', '%'. $request->q .'%');
            }

            return $historical_data->select('file_location', 'title', 'date_from', 'date_to', 'slug')
                                   ->sortable()
                                   ->orderBy('updated_at', 'desc')
                                   ->paginate($entries);
        });

        return $historical_datas;

    }





    public function store($request, $file_location){

        $historical_data = new HistoricalData;
        $historical_data->slug = $this->str->random(16);
        $historical_data->historical_data_id = $this->getHistoricalDataIdInc();
        $historical_data->title = $request->title;
        $historical_data->file_location = $file_location;
        $historical_data->date_from = $this->__dataType->date_parse($request->date_from);
        $historical_data->date_to = $this->__dataType->date_parse($request->date_to);
        $historical_data->created_at = $this->carbon->now();
        $historical_data->updated_at = $this->carbon->now();
        $historical_data->ip_created = request()->ip();
        $historical_data->ip_updated = request()->ip();
        $historical_data->user_created = $this->auth->user()->user_id;
        $historical_data->user_updated = $this->auth->user()->user_id;
        $historical_data->save();
        
        return $historical_data;

    }





    public function update($request, $file_location, $historical_data){

        $historical_data->title = $request->title;
        $historical_data->file_location = $file_location;
        $historical_data->date_from = $this->__dataType->date_parse($request->date_from);
        $historical_data->date_to = $this->__dataType->date_parse($request->date_to);
        $historical_data->updated_at = $this->carbon->now();
        $historical_data->ip_updated = request()->ip();
        $historical_data->user_updated = $this->auth->user()->user_id;
        $historical_data->save();

        return $historical_data;

    }





    public function destroy($historical_data){

        $historical_data->delete();
        return $historical_data;

    }





    public function findBySlug($slug){

        $historical_data = $this->cache->remember('historical_datas:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->historical_data->where('slug', $slug)->first();
        }); 
        
        if(empty($historical_data)){
            abort(404);
        }

        return $historical_data;

    }






    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('title', 'LIKE', '%'. $key .'%');
        });

    }





    public function populate($model, $entries){

        return $model->select('file_location', 'title', 'date_from', 'date_to', 'slug')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate($entries);

    }






    public function getHistoricalDataIdInc(){

        $id = 'HD10001';

        $historical_data = $this->historical_data->select('historical_data_id')->orderBy('historical_data_id', 'desc')->first();

        if($historical_data != null){

            if($historical_data->historical_data_id != null){
                $num = str_replace('HD', '', $historical_data->historical_data_id) + 1;
                $id = 'HD' . $num;
            }
        
        }
        
        return $id;
        
    }






}