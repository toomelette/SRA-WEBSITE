<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class SIDAFundUtilizationSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('sida_fund_utilization.store', 'App\Core\Subscribers\SIDAFundUtilizationSubscriber@onStore');
        $events->listen('sida_fund_utilization.update', 'App\Core\Subscribers\SIDAFundUtilizationSubscriber@onUpdate');
        $events->listen('sida_fund_utilization.destroy', 'App\Core\Subscribers\SIDAFundUtilizationSubscriber@onDestroy');

    }




    public function onStore(){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sida_fund_utilizations:fetch:*');

        $this->session->flash('SIDA_FUND_UTILIZATION_CREATE_SUCCESS', 'The SIDA Fund Utilization has been successfully created!');

    }



    public function onUpdate($sida_fund_utilization){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:sida_fund_utilizations:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sida_fund_utilizations:findBySlug:'. $sida_fund_utilization->slug .'');

        $this->session->flash('SIDA_FUND_UTILIZATION_UPDATE_SUCCESS', 'The SIDA Fund Utilization has been successfully updated!');
        $this->session->flash('SIDA_FUND_UTILIZATION_UPDATE_SUCCESS_SLUG', $sida_fund_utilization->slug);

    }



    public function onDestroy($sida_fund_utilization){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:sida_fund_utilizations:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sida_fund_utilizations:findBySlug:'. $sida_fund_utilization->slug .'');

        $this->session->flash('SIDA_FUND_UTILIZATION_DELETE_SUCCESS', 'The SIDA Fund Utilization has been successfully deleted!');
        $this->session->flash('SIDA_FUND_UTILIZATION_DELETE_SUCCESS_SLUG', $sida_fund_utilization->slug);

    }





}