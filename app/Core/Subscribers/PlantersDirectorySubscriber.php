<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class PlantersDirectorySubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('planters_directory.store', 'App\Core\Subscribers\PlantersDirectorySubscriber@onStore');
        $events->listen('planters_directory.update', 'App\Core\Subscribers\PlantersDirectorySubscriber@onUpdate');
        $events->listen('planters_directory.destroy', 'App\Core\Subscribers\PlantersDirectorySubscriber@onDestroy');

    }




    public function onStore(){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:planters_directories:fetch:*');

        $this->session->flash('PLANTERS_DIRECTORY_CREATE_SUCCESS', 'The Planters Directory has been successfully created!');

    }



    public function onUpdate($planters_directory){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:planters_directories:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:planters_directories:findBySlug:'. $planters_directory->slug .'');

        $this->session->flash('PLANTERS_DIRECTORY_UPDATE_SUCCESS', 'The Planters Directory has been successfully updated!');
        $this->session->flash('PLANTERS_DIRECTORY_UPDATE_SUCCESS_SLUG', $planters_directory->slug);

    }



    public function onDestroy($planters_directory){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:planters_directories:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:planters_directories:findBySlug:'. $planters_directory->slug .'');

        $this->session->flash('PLANTERS_DIRECTORY_DELETE_SUCCESS', 'The Planters Directory has been successfully deleted!');
        $this->session->flash('PLANTERS_DIRECTORY_DELETE_SUCCESS_SLUG', $planters_directory->slug);

    }





}