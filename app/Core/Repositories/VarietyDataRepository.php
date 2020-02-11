<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\VarietyDataInterface;


use App\Models\VarietyData;


class VarietyDataRepository extends BaseRepository implements VarietyDataInterface {
    


    protected $variety_data;



    public function __construct(VarietyData $variety_data){

        $this->variety_data = $variety_data;
        parent::__construct();

    }




    public function store($data, $variety){

        $variety_data = new VarietyData;
        $variety_data->variety_id = $variety->variety_id;
        $variety_data->seq_no = $data['seq_no'];
        $variety_data->field = $data['field'];
        $variety_data->value = $data['value'];
        $variety_data->save();
        
        return $variety_data;

    }





}