<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class MillDistrictSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('mill_district.store', 'App\Core\Subscribers\MillDistrictSubscriber@onStore');
        $events->listen('mill_district.update', 'App\Core\Subscribers\MillDistrictSubscriber@onUpdate');
        $events->listen('mill_district.destroy', 'App\Core\Subscribers\MillDistrictSubscriber@onDestroy');

    }




    public function onStore(){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:mill_districts:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:mill_districts:getAll');

        $this->session->flash('MILL_DISTRICT_CREATE_SUCCESS', 'The Mill District has been successfully created!');

    }



    public function onUpdate($mill_district){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:mill_districts:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:mill_districts:getAll');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:mill_districts:findBySlug:'. $mill_district->slug .'');

        $this->session->flash('MILL_DISTRICT_UPDATE_SUCCESS', 'The Mill District has been successfully updated!');
        $this->session->flash('MILL_DISTRICT_UPDATE_SUCCESS_SLUG', $mill_district->slug);

    }



    public function onDestroy($mill_district){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:mill_districts:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:mill_districts:getAll');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:mill_districts:findBySlug:'. $mill_district->slug .'');

        $this->session->flash('MILL_DISTRICT_DELETE_SUCCESS', 'The Mill District has been successfully deleted!');
        $this->session->flash('MILL_DISTRICT_DELETE_SUCCESS_SLUG', $mill_district->slug);

    }





}