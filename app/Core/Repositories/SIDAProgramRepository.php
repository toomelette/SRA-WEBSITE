<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SIDAProgramInterface;

use App\Models\SIDAProgram;


class SIDAProgramRepository extends BaseRepository implements SIDAProgramInterface {
	


    protected $sida_program;



	public function __construct(SIDAProgram $sida_program){

        $this->sida_program = $sida_program;
        parent::__construct();

    }





    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $sida_programs = $this->cache->remember('sida_programs:fetch:' . $key, 240, function() use ($request, $entries){

            $sida_program = $this->sida_program->newQuery();
            
            if(isset($request->q)){
                $this->search($sida_program, $request->q);
            }

            return $this->populate($sida_program, $entries);

        });

        return $sida_programs;

    }





    public function store($request, $file_location){

        $sida_program = new SIDAProgram;
        $sida_program->slug = $this->str->random(16);
        $sida_program->sida_program_id = $this->getSidaProgramIdInc();
        $sida_program->province_id = $request->province_id;
        $sida_program->mill_district_id = $request->mill_district_id;
        $sida_program->sida_program_cat_id = $request->sida_program_cat_id;
        $sida_program->year = $request->year;
        $sida_program->title = $request->title;
        $sida_program->file_location = $file_location;
        $sida_program->created_at = $this->carbon->now();
        $sida_program->updated_at = $this->carbon->now();
        $sida_program->ip_created = request()->ip();
        $sida_program->ip_updated = request()->ip();
        $sida_program->user_created = $this->auth->user()->user_id;
        $sida_program->user_updated = $this->auth->user()->user_id;
        $sida_program->save();
        
        return $sida_program;

    }





    public function update($request, $file_location, $sida_program){

        $sida_program->province_id = $request->province_id;
        $sida_program->mill_district_id = $request->mill_district_id;
        $sida_program->sida_program_cat_id = $request->sida_program_cat_id;
        $sida_program->year = $request->year;
        $sida_program->title = $request->title;
        $sida_program->file_location = $file_location;
        $sida_program->updated_at = $this->carbon->now();
        $sida_program->ip_updated = request()->ip();
        $sida_program->user_updated = $this->auth->user()->user_id;
        $sida_program->save();

        return $sida_program;

    }





    public function destroy($sida_program){

        $sida_program->delete();
        return $sida_program;

    }





    public function findBySlug($slug){

        $sida_program = $this->cache->remember('sida_programs:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->sida_program->where('slug', $slug)->first();
        }); 
        
        if(empty($sida_program)){
            abort(404);
        }

        return $sida_program;

    }






    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('title', 'LIKE', '%'. $key .'%');
        });

    }





    public function populate($model, $entries){

        return $model->select('file_location', 'title', 'province_id', 'mill_district_id', 'sida_program_cat_id', 'year', 'slug')
                     ->with('province', 'millDistrict', 'sidaProgramCategory')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate($entries);

    }






    public function getSidaProgramIdInc(){

        $id = 'SP10001';

        $sida_program = $this->sida_program->select('sida_program_id')->orderBy('sida_program_id', 'desc')->first();

        if($sida_program != null){

            if($sida_program->sida_program_id != null){
                $num = str_replace('SP', '', $sida_program->sida_program_id) + 1;
                $id = 'SP' . $num;
            }
        
        }
        
        return $id;
        
    }






}