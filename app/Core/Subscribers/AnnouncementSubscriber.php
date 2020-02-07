<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class AnnouncementSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('announcement.store', 'App\Core\Subscribers\AnnouncementSubscriber@onStore');
        $events->listen('announcement.update', 'App\Core\Subscribers\AnnouncementSubscriber@onUpdate');
        $events->listen('announcement.destroy', 'App\Core\Subscribers\AnnouncementSubscriber@onDestroy');

    }




    public function onStore(){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:announcements:fetch:*');

        $this->session->flash('ANNOUNCEMENT_CREATE_SUCCESS', 'The Announcement has been successfully created!');

    }



    public function onUpdate($announcement){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:announcements:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:announcements:findBySlug:'. $announcement->slug .'');

        $this->session->flash('ANNOUNCEMENT_UPDATE_SUCCESS', 'The Announcement has been successfully updated!');
        $this->session->flash('ANNOUNCEMENT_UPDATE_SUCCESS_SLUG', $announcement->slug);

    }



    public function onDestroy($announcement){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:announcements:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:announcements:findBySlug:'. $announcement->slug .'');

        $this->session->flash('ANNOUNCEMENT_DELETE_SUCCESS', 'The Announcement has been successfully deleted!');
        $this->session->flash('ANNOUNCEMENT_DELETE_SUCCESS_SLUG', $announcement->slug);

    }





}