<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class AdministratorSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('administrator.store', 'App\Core\Subscribers\AdministratorSubscriber@onStore');
        $events->listen('administrator.update', 'App\Core\Subscribers\AdministratorSubscriber@onUpdate');
        $events->listen('administrator.destroy', 'App\Core\Subscribers\AdministratorSubscriber@onDestroy');

    }




    public function onStore(){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:administrators:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:administrators:guest:fetch:*');

        $this->session->flash('ADMINISTRATOR_CREATE_SUCCESS', 'The Administrator has been successfully created!');

    }



    public function onUpdate($administrator){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:administrators:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:administrators:guest:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:administrators:findBySlug:'. $administrator->slug .'');

        $this->session->flash('ADMINISTRATOR_UPDATE_SUCCESS', 'The Administrator has been successfully updated!');
        $this->session->flash('ADMINISTRATOR_UPDATE_SUCCESS_SLUG', $administrator->slug);

    }



    public function onDestroy($administrator){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:administrators:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:administrators:guest:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:administrators:findBySlug:'. $administrator->slug .'');

        $this->session->flash('ADMINISTRATOR_DELETE_SUCCESS', 'The Administrator has been successfully deleted!');
        $this->session->flash('ADMINISTRATOR_DELETE_SUCCESS_SLUG', $administrator->slug);

    }





}