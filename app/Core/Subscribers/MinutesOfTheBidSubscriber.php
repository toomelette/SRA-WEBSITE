<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class MinutesOfTheBidSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('minutes_of_the_bid.store', 'App\Core\Subscribers\MinutesOfTheBidSubscriber@onStore');
        $events->listen('minutes_of_the_bid.update', 'App\Core\Subscribers\MinutesOfTheBidSubscriber@onUpdate');
        $events->listen('minutes_of_the_bid.destroy', 'App\Core\Subscribers\MinutesOfTheBidSubscriber@onDestroy');

    }




    public function onStore(){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:minutes_of_the_bid:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:minutes_of_the_bid:guestFetch:*');

        $this->session->flash('MINUTES_OF_THE_BID_CREATE_SUCCESS', 'The Minutes of the Bid has been successfully created!');

    }



    public function onUpdate($minutes_of_the_bid){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:minutes_of_the_bid:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:minutes_of_the_bid:guestFetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:minutes_of_the_bid:findBySlug:'. $minutes_of_the_bid->slug .'');

        $this->session->flash('MINUTES_OF_THE_BID_UPDATE_SUCCESS', 'The Minutes of the Bid has been successfully updated!');
        $this->session->flash('MINUTES_OF_THE_BID_UPDATE_SUCCESS_SLUG', $minutes_of_the_bid->slug);

    }



    public function onDestroy($minutes_of_the_bid){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:minutes_of_the_bid:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:minutes_of_the_bid:guestFetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:minutes_of_the_bid:findBySlug:'. $minutes_of_the_bid->slug .'');

        $this->session->flash('MINUTES_OF_THE_BID_DELETE_SUCCESS', 'The Minutes of the Bid has been successfully deleted!');
        $this->session->flash('MINUTES_OF_THE_BID_DELETE_SUCCESS_SLUG', $minutes_of_the_bid->slug);

    }





}