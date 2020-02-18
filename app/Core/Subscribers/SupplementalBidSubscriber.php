<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class SupplementalBidSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('supplemental_bid.store', 'App\Core\Subscribers\SupplementalBidSubscriber@onStore');
        $events->listen('supplemental_bid.update', 'App\Core\Subscribers\SupplementalBidSubscriber@onUpdate');
        $events->listen('supplemental_bid.destroy', 'App\Core\Subscribers\SupplementalBidSubscriber@onDestroy');

    }




    public function onStore(){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:supplemental_bids:fetch:*');

        $this->session->flash('SUPPLEMENTAL_BID_CREATE_SUCCESS', 'The Supplemental Bid has been successfully created!');

    }



    public function onUpdate($supplemental_bid){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:supplemental_bids:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:supplemental_bids:findBySlug:'. $supplemental_bid->slug .'');

        $this->session->flash('SUPPLEMENTAL_BID_UPDATE_SUCCESS', 'The Supplemental Bid has been successfully updated!');
        $this->session->flash('SUPPLEMENTAL_BID_UPDATE_SUCCESS_SLUG', $supplemental_bid->slug);

    }



    public function onDestroy($supplemental_bid){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:supplemental_bids:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:supplemental_bids:findBySlug:'. $supplemental_bid->slug .'');

        $this->session->flash('SUPPLEMENTAL_BID_DELETE_SUCCESS', 'The Supplemental Bid has been successfully deleted!');
        $this->session->flash('SUPPLEMENTAL_BID_DELETE_SUCCESS_SLUG', $supplemental_bid->slug);

    }





}