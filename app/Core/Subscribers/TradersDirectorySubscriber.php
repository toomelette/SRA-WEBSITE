<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class TradersDirectorySubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('traders_directory.store', 'App\Core\Subscribers\TradersDirectorySubscriber@onStore');
        $events->listen('traders_directory.update', 'App\Core\Subscribers\TradersDirectorySubscriber@onUpdate');
        $events->listen('traders_directory.destroy', 'App\Core\Subscribers\TradersDirectorySubscriber@onDestroy');

    }




    public function onStore(){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:traders_directories:fetch:*');

        $this->session->flash('TRADERS_DIRECTORY_CREATE_SUCCESS', 'The Traders Directory has been successfully created!');

    }



    public function onUpdate($traders_directory){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:traders_directories:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:traders_directories:findBySlug:'. $traders_directory->slug .'');

        $this->session->flash('TRADERS_DIRECTORY_UPDATE_SUCCESS', 'The Traders Directory has been successfully updated!');
        $this->session->flash('TRADERS_DIRECTORY_UPDATE_SUCCESS_SLUG', $traders_directory->slug);

    }



    public function onDestroy($traders_directory){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:traders_directories:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:traders_directories:findBySlug:'. $traders_directory->slug .'');

        $this->session->flash('TRADERS_DIRECTORY_DELETE_SUCCESS', 'The Traders Directory has been successfully deleted!');
        $this->session->flash('TRADERS_DIRECTORY_DELETE_SUCCESS_SLUG', $traders_directory->slug);

    }





}