<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class VacantPositionSubscriber extends BaseSubscriber{




    public function __construct(){
        parent::__construct();
    }




    public function subscribe($events){

        $events->listen('vacant_position.store', 'App\Core\Subscribers\VacantPositionSubscriber@onStore');
        $events->listen('vacant_position.update', 'App\Core\Subscribers\VacantPositionSubscriber@onUpdate');
        $events->listen('vacant_position.destroy', 'App\Core\Subscribers\VacantPositionSubscriber@onDestroy');

    }




    public function onStore(){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:vacant_positions:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:vacant_positions:guest:fetch:*');

        $this->session->flash('VACANT_POSITION_CREATE_SUCCESS', 'The Vacant Position has been successfully created!');

    }



    public function onUpdate($vacant_position){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:vacant_positions:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:vacant_positions:guest:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:vacant_positions:findBySlug:'. $vacant_position->slug .'');

        $this->session->flash('VACANT_POSITION_UPDATE_SUCCESS', 'The Vacant Position has been successfully updated!');
        $this->session->flash('VACANT_POSITION_UPDATE_SUCCESS_SLUG', $vacant_position->slug);

    }



    public function onDestroy($vacant_position){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:vacant_positions:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:vacant_positions:guest:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:vacant_positions:findBySlug:'. $vacant_position->slug .'');

        $this->session->flash('VACANT_POSITION_DELETE_SUCCESS', 'The Vacant Position has been successfully deleted!');
        $this->session->flash('VACANT_POSITION_DELETE_SUCCESS_SLUG', $vacant_position->slug);

    }





}