<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class NoticeOfAwardSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('notice_of_award.store', 'App\Core\Subscribers\NoticeOfAwardSubscriber@onStore');
        $events->listen('notice_of_award.update', 'App\Core\Subscribers\NoticeOfAwardSubscriber@onUpdate');
        $events->listen('notice_of_award.destroy', 'App\Core\Subscribers\NoticeOfAwardSubscriber@onDestroy');

    }




    public function onStore(){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:notice_of_award:fetch:*');

        $this->session->flash('NOTICE_OF_AWARD_CREATE_SUCCESS', 'The Notice of Award has been successfully created!');

    }



    public function onUpdate($notice_of_award){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:notice_of_award:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:notice_of_award:findBySlug:'. $notice_of_award->slug .'');

        $this->session->flash('NOTICE_OF_AWARD_UPDATE_SUCCESS', 'The Invitation to Bid has been successfully updated!');
        $this->session->flash('NOTICE_OF_AWARD_UPDATE_SUCCESS_SLUG', $notice_of_award->slug);

    }



    public function onDestroy($notice_of_award){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:notice_of_award:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:notice_of_award:findBySlug:'. $notice_of_award->slug .'');

        $this->session->flash('NOTICE_OF_AWARD_DELETE_SUCCESS', 'The Invitation to Bid has been successfully deleted!');
        $this->session->flash('NOTICE_OF_AWARD_DELETE_SUCCESS_SLUG', $notice_of_award->slug);

    }





}