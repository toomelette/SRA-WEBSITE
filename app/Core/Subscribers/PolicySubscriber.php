<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class PolicySubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('policy.store', 'App\Core\Subscribers\PolicySubscriber@onStore');
        $events->listen('policy.update', 'App\Core\Subscribers\PolicySubscriber@onUpdate');
        $events->listen('policy.destroy', 'App\Core\Subscribers\PolicySubscriber@onDestroy');

    }




    public function onStore(){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:policies:fetch:*');

        $this->session->flash('POLICY_CREATE_SUCCESS', 'The Policy has been successfully created!');

    }



    public function onUpdate($policy){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:policies:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:policies:findBySlug:'. $policy->slug .'');

        $this->session->flash('POLICY_UPDATE_SUCCESS', 'The Policy has been successfully updated!');
        $this->session->flash('POLICY_UPDATE_SUCCESS_SLUG', $policy->slug);

    }



    public function onDestroy($policy){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:policies:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:policies:findBySlug:'. $policy->slug .'');

        $this->session->flash('POLICY_DELETE_SUCCESS', 'The Policy has been successfully deleted!');
        $this->session->flash('POLICY_DELETE_SUCCESS_SLUG', $policy->slug);

    }





}