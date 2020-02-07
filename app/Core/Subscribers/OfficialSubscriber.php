<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class OfficialSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('official.store', 'App\Core\Subscribers\OfficialSubscriber@onStore');
        $events->listen('official.update', 'App\Core\Subscribers\OfficialSubscriber@onUpdate');
        $events->listen('official.destroy', 'App\Core\Subscribers\OfficialSubscriber@onDestroy');

    }




    public function onStore(){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:officials:fetch:*');

        $this->session->flash('OFFICIAL_CREATE_SUCCESS', 'The Official has been successfully created!');

    }



    public function onUpdate($official){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:officials:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:officials:findBySlug:'. $official->slug .'');

        $this->session->flash('OFFICIAL_UPDATE_SUCCESS', 'The Official has been successfully updated!');
        $this->session->flash('OFFICIAL_UPDATE_SUCCESS_SLUG', $official->slug);

    }



    public function onDestroy($official){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:officials:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:officials:findBySlug:'. $official->slug .'');

        $this->session->flash('OFFICIAL_DELETE_SUCCESS', 'The Official has been successfully deleted!');
        $this->session->flash('OFFICIAL_DELETE_SUCCESS_SLUG', $official->slug);

    }





}