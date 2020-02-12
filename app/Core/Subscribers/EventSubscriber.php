<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class EventSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('event.store', 'App\Core\Subscribers\EventSubscriber@onStore');
        $events->listen('event.update', 'App\Core\Subscribers\EventSubscriber@onUpdate');
        $events->listen('event.destroy', 'App\Core\Subscribers\EventSubscriber@onDestroy');

    }




    public function onStore(){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:events:fetch:*');

        $this->session->flash('EVENT_CREATE_SUCCESS', 'The Event has been successfully created!');

    }



    public function onUpdate($event){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:events:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:events:findBySlug:'. $event->slug .'');

        $this->session->flash('EVENT_UPDATE_SUCCESS', 'The Event has been successfully updated!');
        $this->session->flash('EVENT_UPDATE_SUCCESS_SLUG', $event->slug);

    }



    public function onDestroy($event){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:events:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:events:findBySlug:'. $event->slug .'');

        $this->session->flash('EVENT_DELETE_SUCCESS', 'The Event has been successfully deleted!');
        $this->session->flash('EVENT_DELETE_SUCCESS_SLUG', $event->slug);

    }





}