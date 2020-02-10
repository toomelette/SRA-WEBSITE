<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class HistoricalDataSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('historical_data.store', 'App\Core\Subscribers\HistoricalDataSubscriber@onStore');
        $events->listen('historical_data.update', 'App\Core\Subscribers\HistoricalDataSubscriber@onUpdate');
        $events->listen('historical_data.destroy', 'App\Core\Subscribers\HistoricalDataSubscriber@onDestroy');

    }




    public function onStore(){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:historical_datas:fetch:*');

        $this->session->flash('HISTORICAL_DATA_CREATE_SUCCESS', 'The Historical Data has been successfully created!');

    }



    public function onUpdate($historical_data){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:historical_datas:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:historical_datas:findBySlug:'. $historical_data->slug .'');

        $this->session->flash('HISTORICAL_DATA_UPDATE_SUCCESS', 'The Historical Data has been successfully updated!');
        $this->session->flash('HISTORICAL_DATA_UPDATE_SUCCESS_SLUG', $historical_data->slug);

    }



    public function onDestroy($historical_data){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:historical_datas:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:historical_datas:findBySlug:'. $historical_data->slug .'');

        $this->session->flash('HISTORICAL_DATA_DELETE_SUCCESS', 'The Historical Data has been successfully deleted!');
        $this->session->flash('HISTORICAL_DATA_DELETE_SUCCESS_SLUG', $historical_data->slug);

    }





}