<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class AdminCornerSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('admin_corner.store', 'App\Core\Subscribers\AdminCornerSubscriber@onStore');
        $events->listen('admin_corner.update', 'App\Core\Subscribers\AdminCornerSubscriber@onUpdate');
        $events->listen('admin_corner.destroy', 'App\Core\Subscribers\AdminCornerSubscriber@onDestroy');

    }




    public function onStore(){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:admin_corners:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:admin_corners:guestFetch:*');

        $this->session->flash('ADMIN_CORNER_CREATE_SUCCESS', 'The Administrators Record has been successfully created!');

    }



    public function onUpdate($admin_corner){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:admin_corners:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:admin_corners:guestFetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:admin_corners:findBySlug:'. $admin_corner->slug .'');

        $this->session->flash('ADMIN_CORNER_UPDATE_SUCCESS', 'The Administrators Record has been successfully updated!');
        $this->session->flash('ADMIN_CORNER_UPDATE_SUCCESS_SLUG', $admin_corner->slug);

    }



    public function onDestroy($admin_corner){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:admin_corners:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:admin_corners:guestFetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:admin_corners:findBySlug:'. $admin_corner->slug .'');

        $this->session->flash('ADMIN_CORNER_DELETE_SUCCESS', 'The Administrators Record has been successfully deleted!');
        $this->session->flash('ADMIN_CORNER_DELETE_SUCCESS_SLUG', $admin_corner->slug);

    }





}