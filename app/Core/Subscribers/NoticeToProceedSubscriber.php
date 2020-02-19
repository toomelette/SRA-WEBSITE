<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class NoticeToProceedSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('notice_to_proceed.store', 'App\Core\Subscribers\NoticeToProceedSubscriber@onStore');
        $events->listen('notice_to_proceed.update', 'App\Core\Subscribers\NoticeToProceedSubscriber@onUpdate');
        $events->listen('notice_to_proceed.destroy', 'App\Core\Subscribers\NoticeToProceedSubscriber@onDestroy');

    }




    public function onStore(){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:notice_to_proceed:fetch:*');

        $this->session->flash('NOTICE_TO_PROCEED_CREATE_SUCCESS', 'The Notice to Proceed has been successfully created!');

    }



    public function onUpdate($notice_to_proceed){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:notice_to_proceed:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:notice_to_proceed:findBySlug:'. $notice_to_proceed->slug .'');

        $this->session->flash('NOTICE_TO_PROCEED_UPDATE_SUCCESS', 'The Notice to Proceed has been successfully updated!');
        $this->session->flash('NOTICE_TO_PROCEED_UPDATE_SUCCESS_SLUG', $notice_to_proceed->slug);

    }



    public function onDestroy($notice_to_proceed){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:notice_to_proceed:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:notice_to_proceed:findBySlug:'. $notice_to_proceed->slug .'');

        $this->session->flash('NOTICE_TO_PROCEED_DELETE_SUCCESS', 'The Notice to Proceed has been successfully deleted!');
        $this->session->flash('NOTICE_TO_PROCEED_DELETE_SUCCESS_SLUG', $notice_to_proceed->slug);

    }





}