<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class MillingScheduleSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('milling_schedule.store', 'App\Core\Subscribers\MillingScheduleSubscriber@onStore');
        $events->listen('milling_schedule.update', 'App\Core\Subscribers\MillingScheduleSubscriber@onUpdate');
        $events->listen('milling_schedule.destroy', 'App\Core\Subscribers\MillingScheduleSubscriber@onDestroy');

    }




    public function onStore(){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:milling_schedules:fetch:*');

        $this->session->flash('MILLING_SCHEDULE_CREATE_SUCCESS', 'The Milling Schedule has been successfully created!');

    }



    public function onUpdate($milling_schedule){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:milling_schedules:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:milling_schedules:findBySlug:'. $milling_schedule->slug .'');

        $this->session->flash('MILLING_SCHEDULE_UPDATE_SUCCESS', 'The Milling Schedule has been successfully updated!');
        $this->session->flash('MILLING_SCHEDULE_UPDATE_SUCCESS_SLUG', $milling_schedule->slug);

    }



    public function onDestroy($milling_schedule){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:milling_schedules:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:milling_schedules:findBySlug:'. $milling_schedule->slug .'');

        $this->session->flash('MILLING_SCHEDULE_DELETE_SUCCESS', 'The Milling Schedule has been successfully deleted!');
        $this->session->flash('MILLING_SCHEDULE_DELETE_SUCCESS_SLUG', $milling_schedule->slug);

    }





}