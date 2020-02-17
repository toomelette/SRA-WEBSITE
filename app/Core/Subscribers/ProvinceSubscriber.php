<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class ProvinceSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('province.store', 'App\Core\Subscribers\ProvinceSubscriber@onStore');
        $events->listen('province.update', 'App\Core\Subscribers\ProvinceSubscriber@onUpdate');
        $events->listen('province.destroy', 'App\Core\Subscribers\ProvinceSubscriber@onDestroy');

    }




    public function onStore(){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:provinces:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:provinces:getAll');

        $this->session->flash('PROVINCE_CREATE_SUCCESS', 'The Province has been successfully created!');

    }



    public function onUpdate($province){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:provinces:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:provinces:getAll');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:provinces:findBySlug:'. $province->slug .'');

        $this->session->flash('PROVINCE_UPDATE_SUCCESS', 'The Province has been successfully updated!');
        $this->session->flash('PROVINCE_UPDATE_SUCCESS_SLUG', $province->slug);

    }



    public function onDestroy($province){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:provinces:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:provinces:getAll');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:provinces:findBySlug:'. $province->slug .'');

        $this->session->flash('PROVINCE_DELETE_SUCCESS', 'The Province has been successfully deleted!');
        $this->session->flash('PROVINCE_DELETE_SUCCESS_SLUG', $province->slug);

    }





}