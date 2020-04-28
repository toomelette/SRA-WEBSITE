<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class SIDAGuidelineSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('sida_guideline.store', 'App\Core\Subscribers\SIDAGuidelineSubscriber@onStore');
        $events->listen('sida_guideline.update', 'App\Core\Subscribers\SIDAGuidelineSubscriber@onUpdate');
        $events->listen('sida_guideline.destroy', 'App\Core\Subscribers\SIDAGuidelineSubscriber@onDestroy');

    }




    public function onStore(){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sida_guidelines:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sida_guidelines:guestFetch:*');

        $this->session->flash('SIDA_GUIDELINE_CREATE_SUCCESS', 'The SIDA Guideline has been successfully created!');

    }



    public function onUpdate($sida_guideline){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:sida_guidelines:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sida_guidelines:guestFetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sida_guidelines:findBySlug:'. $sida_guideline->slug .'');

        $this->session->flash('SIDA_GUIDELINE_UPDATE_SUCCESS', 'The SIDA Guideline has been successfully updated!');
        $this->session->flash('SIDA_GUIDELINE_UPDATE_SUCCESS_SLUG', $sida_guideline->slug);

    }



    public function onDestroy($sida_guideline){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:sida_guidelines:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sida_guidelines:guestFetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sida_guidelines:findBySlug:'. $sida_guideline->slug .'');

        $this->session->flash('SIDA_GUIDELINE_DELETE_SUCCESS', 'The SIDA Guideline has been successfully deleted!');
        $this->session->flash('SIDA_GUIDELINE_DELETE_SUCCESS_SLUG', $sida_guideline->slug);

    }





}