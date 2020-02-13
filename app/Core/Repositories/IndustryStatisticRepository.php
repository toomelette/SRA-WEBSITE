<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\IndustryStatisticInterface;

use App\Models\IndustryStatistic;


class IndustryStatisticRepository extends BaseRepository implements IndustryStatisticInterface {
	


    protected $industry_statistic;



	public function __construct(IndustryStatistic $industry_statistic){

        $this->industry_statistic = $industry_statistic;
        parent::__construct();

    }





    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $industry_statistics = $this->cache->remember('industry_statistics:fetch:' . $key, 240, function() use ($request, $entries){

            $industry_statistic = $this->industry_statistic->newQuery();
            
            if(isset($request->q)){
                $this->search($industry_statistic, $request->q);
            }

            return $this->populate($industry_statistic, $entries);

        });

        return $industry_statistics;

    }





    public function store($request, $file_location){

        $industry_statistic = new IndustryStatistic;
        $industry_statistic->slug = $this->str->random(16);
        $industry_statistic->industry_statistic_id = $this->getIndustryStatisticIdInc();
        $industry_statistic->file_location = $file_location;
        $industry_statistic->crop_year_id = $request->crop_year_id;
        $industry_statistic->industry_statistics_category_id = $request->industry_statistics_category_id;
        $industry_statistic->title = $request->title;
        $industry_statistic->cut_off_date = $this->__dataType->date_parse($request->cut_off_date);
        $industry_statistic->created_at = $this->carbon->now();
        $industry_statistic->updated_at = $this->carbon->now();
        $industry_statistic->ip_created = request()->ip();
        $industry_statistic->ip_updated = request()->ip();
        $industry_statistic->user_created = $this->auth->user()->user_id;
        $industry_statistic->user_updated = $this->auth->user()->user_id;
        $industry_statistic->save();
        
        return $industry_statistic;

    }





    public function update($request, $file_location, $industry_statistic){

        $industry_statistic->file_location = $file_location;
        $industry_statistic->crop_year_id = $request->crop_year_id;
        $industry_statistic->industry_statistics_category_id = $request->industry_statistics_category_id;
        $industry_statistic->title = $request->title;
        $industry_statistic->cut_off_date = $this->__dataType->date_parse($request->cut_off_date);
        $industry_statistic->updated_at = $this->carbon->now();
        $industry_statistic->ip_updated = request()->ip();
        $industry_statistic->user_updated = $this->auth->user()->user_id;
        $industry_statistic->save();

        return $industry_statistic;

    }





    public function destroy($industry_statistic){

        $industry_statistic->delete();
        return $industry_statistic;

    }





    public function findBySlug($slug){

        $industry_statistic = $this->cache->remember('industry_statistics:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->industry_statistic->where('slug', $slug)->first();
        }); 
        
        if(empty($industry_statistic)){
            abort(404);
        }

        return $industry_statistic;

    }






    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('title', 'LIKE', '%'. $key .'%')
                      ->orwhereHas('industryStatisticsCategory', function ($model) use ($key) {
                            $model->where('name', 'LIKE', '%'. $key .'%');
                        })
                      ->orwhereHas('cropYear', function ($model) use ($key) {
                            $model->where('name', 'LIKE', '%'. $key .'%');
                        });
        });

    }





    public function populate($model, $entries){

        return $model->select('file_location', 'crop_year_id', 'industry_statistics_category_id', 'title', 'cut_off_date', 'slug')
                     ->with('cropYear', 'industryStatisticsCategory')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate($entries);

    }






    public function getIndustryStatisticIdInc(){

        $id = 'IS10001';

        $industry_statistic = $this->industry_statistic->select('industry_statistic_id')->orderBy('industry_statistic_id', 'desc')->first();

        if($industry_statistic != null){

            if($industry_statistic->industry_statistic_id != null){
                $num = str_replace('IS', '', $industry_statistic->industry_statistic_id) + 1;
                $id = 'IS' . $num;
            }
        
        }
        
        return $id;
        
    }






}