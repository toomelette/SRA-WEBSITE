<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\CropYearInterface;


use App\Models\CropYear;


class CropYearRepository extends BaseRepository implements CropYearInterface {
	



    protected $crop_year;




	public function __construct(CropYear $crop_year){

        $this->crop_year = $crop_year;
        parent::__construct();

    }





    public function getAll(){

        $crop_years = $this->cache->remember('crop_years:getAll', 240, function(){
            return $this->crop_year->select('crop_year_id','name')->get();
        });
        
        return $crop_years;

    }





}