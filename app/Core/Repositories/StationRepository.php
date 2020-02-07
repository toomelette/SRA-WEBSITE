<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\StationInterface;

use App\Models\Station;


class StationRepository extends BaseRepository implements StationInterface {
	


    protected $station;



	public function __construct(Station $station){

        $this->station = $station;
        parent::__construct();

    }





    public function getAll(){

        $stations = $this->cache->remember('stations:getAll', 240, function(){
            return $this->station->select('station_id', 'name')
                                 ->get();
        });
        
        return $stations;

    }






}