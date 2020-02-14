<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\BlockFarmInterface;

use App\Models\BlockFarm;


class BlockFarmRepository extends BaseRepository implements BlockFarmInterface {
	


    protected $block_farm;



	public function __construct(BlockFarm $block_farm){

        $this->block_farm = $block_farm;
        parent::__construct();

    }





    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $block_farms = $this->cache->remember('block_farms:fetch:' . $key, 240, function() use ($request, $entries){

            $block_farm = $this->block_farm->newQuery();
            
            if(isset($request->q)){
                $this->search($block_farm, $request->q);
            }

            return $this->populate($block_farm, $entries);

        });

        return $block_farms;

    }





    public function store($request, $file_location){

        $block_farm = new BlockFarm;
        $block_farm->slug = $this->str->random(16);
        $block_farm->block_farm_id = $this->getBlockFarmIdInc();
        $block_farm->title = $request->title;
        $block_farm->file_location = $file_location;
        $block_farm->created_at = $this->carbon->now();
        $block_farm->updated_at = $this->carbon->now();
        $block_farm->ip_created = request()->ip();
        $block_farm->ip_updated = request()->ip();
        $block_farm->user_created = $this->auth->user()->user_id;
        $block_farm->user_updated = $this->auth->user()->user_id;
        $block_farm->save();
        
        return $block_farm;

    }





    public function update($request, $file_location, $block_farm){

        $block_farm->title = $request->title;
        $block_farm->file_location = $file_location;
        $block_farm->updated_at = $this->carbon->now();
        $block_farm->ip_updated = request()->ip();
        $block_farm->user_updated = $this->auth->user()->user_id;
        $block_farm->save();

        return $block_farm;

    }





    public function destroy($block_farm){

        $block_farm->delete();
        return $block_farm;

    }





    public function findBySlug($slug){

        $block_farm = $this->cache->remember('block_farms:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->block_farm->where('slug', $slug)->first();
        }); 
        
        if(empty($block_farm)){
            abort(404);
        }

        return $block_farm;

    }






    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('title', 'LIKE', '%'. $key .'%');
        });

    }





    public function populate($model, $entries){

        return $model->select('file_location', 'title', 'slug')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate($entries);

    }






    public function getBlockFarmIdInc(){

        $id = 'SP10001';

        $block_farm = $this->block_farm->select('block_farm_id')->orderBy('block_farm_id', 'desc')->first();

        if($block_farm != null){

            if($block_farm->block_farm_id != null){
                $num = str_replace('SP', '', $block_farm->block_farm_id) + 1;
                $id = 'SP' . $num;
            }
        
        }
        
        return $id;
        
    }






}