<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class OfficeSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('office.store', 'App\Core\Subscribers\OfficeSubscriber@onStore');
        $events->listen('office.update', 'App\Core\Subscribers\OfficeSubscriber@onUpdate');
        $events->listen('office.destroy', 'App\Core\Subscribers\OfficeSubscriber@onDestroy');

    }




    public function onStore(){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:offices:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:offices:getAll');

        $this->session->flash('OFFICE_CREATE_SUCCESS', 'The Office has been successfully created!');

    }



    public function onUpdate($office){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:offices:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:offices:findBySlug:'. $office->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:offices:getAll');

        $this->session->flash('OFFICE_UPDATE_SUCCESS', 'The Office has been successfully updated!');
        $this->session->flash('OFFICE_UPDATE_SUCCESS_SLUG', $office->slug);

    }



    public function onDestroy($office){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:offices:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:offices:findBySlug:'. $office->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:offices:getAll');

        $this->session->flash('OFFICE_DELETE_SUCCESS', 'The Office has been successfully deleted!');
        $this->session->flash('OFFICE_DELETE_SUCCESS_SLUG', $office->slug);

    }





}