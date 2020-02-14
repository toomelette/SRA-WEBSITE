<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class CropEstimateSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('crop_estimate.store', 'App\Core\Subscribers\CropEstimateSubscriber@onStore');
        $events->listen('crop_estimate.update', 'App\Core\Subscribers\CropEstimateSubscriber@onUpdate');
        $events->listen('crop_estimate.destroy', 'App\Core\Subscribers\CropEstimateSubscriber@onDestroy');

    }




    public function onStore(){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:crop_estimates:fetch:*');

        $this->session->flash('CROP_ESTIMATE_CREATE_SUCCESS', 'The Crop Estimate has been successfully created!');

    }



    public function onUpdate($crop_estimate){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:crop_estimates:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:crop_estimates:findBySlug:'. $crop_estimate->slug .'');

        $this->session->flash('CROP_ESTIMATE_UPDATE_SUCCESS', 'The Crop Estimate has been successfully updated!');
        $this->session->flash('CROP_ESTIMATE_UPDATE_SUCCESS_SLUG', $crop_estimate->slug);

    }



    public function onDestroy($crop_estimate){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:crop_estimates:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:crop_estimates:findBySlug:'. $crop_estimate->slug .'');

        $this->session->flash('CROP_ESTIMATE_DELETE_SUCCESS', 'The Crop Estimate has been successfully deleted!');
        $this->session->flash('CROP_ESTIMATE_DELETE_SUCCESS_SLUG', $crop_estimate->slug);

    }





}