<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class IndustryStatisticSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('industry_statistic.store', 'App\Core\Subscribers\IndustryStatisticSubscriber@onStore');
        $events->listen('industry_statistic.update', 'App\Core\Subscribers\IndustryStatisticSubscriber@onUpdate');
        $events->listen('industry_statistic.destroy', 'App\Core\Subscribers\IndustryStatisticSubscriber@onDestroy');

    }




    public function onStore(){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:industry_statistics:fetch:*');

        $this->session->flash('INDUSTRY_STATISTIC_CREATE_SUCCESS', 'The Industry Statistic has been successfully created!');

    }



    public function onUpdate($industry_statistic){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:industry_statistics:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:industry_statistics:findBySlug:'. $industry_statistic->slug .'');

        $this->session->flash('INDUSTRY_STATISTIC_UPDATE_SUCCESS', 'The Industry Statistic has been successfully updated!');
        $this->session->flash('INDUSTRY_STATISTIC_UPDATE_SUCCESS_SLUG', $industry_statistic->slug);

    }



    public function onDestroy($industry_statistic){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:industry_statistics:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:industry_statistics:findBySlug:'. $industry_statistic->slug .'');

        $this->session->flash('INDUSTRY_STATISTIC_DELETE_SUCCESS', 'The Industry Statistic has been successfully deleted!');
        $this->session->flash('INDUSTRY_STATISTIC_DELETE_SUCCESS_SLUG', $industry_statistic->slug);

    }





}