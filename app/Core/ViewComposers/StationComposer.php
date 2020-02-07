<?php

namespace App\Core\ViewComposers;


use View;
use App\Core\Interfaces\StationInterface;


class StationComposer{
   



	protected $station_repo;




	public function __construct(StationInterface $station_repo){

		$this->station_repo = $station_repo;

	}





    public function compose($view){

        $stations = $this->station_repo->getAll();
        
    	$view->with('global_stations_all', $stations);

    }






}