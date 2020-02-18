<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class SIDALawSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('sida_law.store', 'App\Core\Subscribers\SIDALawSubscriber@onStore');
        $events->listen('sida_law.update', 'App\Core\Subscribers\SIDALawSubscriber@onUpdate');
        $events->listen('sida_law.destroy', 'App\Core\Subscribers\SIDALawSubscriber@onDestroy');

    }




    public function onStore(){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sida_laws:fetch:*');

        $this->session->flash('SIDA_LAW_CREATE_SUCCESS', 'The SIDA Law has been successfully created!');

    }



    public function onUpdate($sida_law){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:sida_laws:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sida_laws:findBySlug:'. $sida_law->slug .'');

        $this->session->flash('SIDA_LAW_UPDATE_SUCCESS', 'The SIDA Law has been successfully updated!');
        $this->session->flash('SIDA_LAW_UPDATE_SUCCESS_SLUG', $sida_law->slug);

    }



    public function onDestroy($sida_law){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:sida_laws:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sida_laws:findBySlug:'. $sida_law->slug .'');

        $this->session->flash('SIDA_LAW_DELETE_SUCCESS', 'The SIDA Law has been successfully deleted!');
        $this->session->flash('SIDA_LAW_DELETE_SUCCESS_SLUG', $sida_law->slug);

    }





}