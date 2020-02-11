<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class VarietySubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('variety.store', 'App\Core\Subscribers\VarietySubscriber@onStore');
        $events->listen('variety.update', 'App\Core\Subscribers\VarietySubscriber@onUpdate');
        $events->listen('variety.destroy', 'App\Core\Subscribers\VarietySubscriber@onDestroy');

    }




    public function onStore(){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:varieties:fetch:*');

        $this->session->flash('VARIETY_CREATE_SUCCESS', 'The Variety has been successfully created!');

    }



    public function onUpdate($variety){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:varieties:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:varieties:findBySlug:'. $variety->slug .'');

        $this->session->flash('VARIETY_UPDATE_SUCCESS', 'The Variety has been successfully updated!');
        $this->session->flash('VARIETY_UPDATE_SUCCESS_SLUG', $variety->slug);

    }



    public function onDestroy($variety){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:varieties:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:varieties:findBySlug:'. $variety->slug .'');

        $this->session->flash('VARIETY_DELETE_SUCCESS', 'The Variety has been successfully deleted!');
        $this->session->flash('VARIETY_DELETE_SUCCESS_SLUG', $variety->slug);

    }





}