<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class BioenergySubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('bioenergy.store', 'App\Core\Subscribers\BioenergySubscriber@onStore');
        $events->listen('bioenergy.update', 'App\Core\Subscribers\BioenergySubscriber@onUpdate');
        $events->listen('bioenergy.destroy', 'App\Core\Subscribers\BioenergySubscriber@onDestroy');

    }




    public function onStore(){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:bioenergy:fetch:*');

        $this->session->flash('BIOENERGY_CREATE_SUCCESS', 'The Bioenergy has been successfully created!');

    }



    public function onUpdate($bioenergy){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:bioenergy:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:bioenergy:findBySlug:'. $bioenergy->slug .'');

        $this->session->flash('BIOENERGY_UPDATE_SUCCESS', 'The Bioenergy has been successfully updated!');
        $this->session->flash('BIOENERGY_UPDATE_SUCCESS_SLUG', $bioenergy->slug);

    }



    public function onDestroy($bioenergy){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:bioenergy:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:bioenergy:findBySlug:'. $bioenergy->slug .'');

        $this->session->flash('BIOENERGY_DELETE_SUCCESS', 'The Bioenergy has been successfully deleted!');
        $this->session->flash('BIOENERGY_DELETE_SUCCESS_SLUG', $bioenergy->slug);

    }





}