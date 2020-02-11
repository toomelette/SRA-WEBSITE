<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class ResearchSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('research.store', 'App\Core\Subscribers\ResearchSubscriber@onStore');
        $events->listen('research.update', 'App\Core\Subscribers\ResearchSubscriber@onUpdate');
        $events->listen('research.destroy', 'App\Core\Subscribers\ResearchSubscriber@onDestroy');

    }




    public function onStore(){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:researches:fetch:*');

        $this->session->flash('RESEARCH_CREATE_SUCCESS', 'The Research has been successfully created!');

    }



    public function onUpdate($research){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:researches:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:researches:findBySlug:'. $research->slug .'');

        $this->session->flash('RESEARCH_UPDATE_SUCCESS', 'The Research has been successfully updated!');
        $this->session->flash('RESEARCH_UPDATE_SUCCESS_SLUG', $research->slug);

    }



    public function onDestroy($research){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:researches:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:researches:findBySlug:'. $research->slug .'');

        $this->session->flash('RESEARCH_DELETE_SUCCESS', 'The Research has been successfully deleted!');
        $this->session->flash('RESEARCH_DELETE_SUCCESS_SLUG', $research->slug);

    }





}