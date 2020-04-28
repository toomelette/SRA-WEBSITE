<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class InvitationToBidSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('invitation_to_bid.store', 'App\Core\Subscribers\InvitationToBidSubscriber@onStore');
        $events->listen('invitation_to_bid.update', 'App\Core\Subscribers\InvitationToBidSubscriber@onUpdate');
        $events->listen('invitation_to_bid.destroy', 'App\Core\Subscribers\InvitationToBidSubscriber@onDestroy');

    }




    public function onStore(){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:invitations_to_bid:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:invitations_to_bid:guestFetch:*');

        $this->session->flash('INVITATION_TO_BID_CREATE_SUCCESS', 'The Invitation to Bid has been successfully created!');

    }



    public function onUpdate($invitation_to_bid){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:invitations_to_bid:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:invitations_to_bid:guestFetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:invitations_to_bid:findBySlug:'. $invitation_to_bid->slug .'');

        $this->session->flash('INVITATION_TO_BID_UPDATE_SUCCESS', 'The Invitation to Bid has been successfully updated!');
        $this->session->flash('INVITATION_TO_BID_UPDATE_SUCCESS_SLUG', $invitation_to_bid->slug);

    }



    public function onDestroy($invitation_to_bid){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:invitations_to_bid:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:invitations_to_bid:guestFetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:invitations_to_bid:findBySlug:'. $invitation_to_bid->slug .'');

        $this->session->flash('INVITATION_TO_BID_DELETE_SUCCESS', 'The Invitation to Bid has been successfully deleted!');
        $this->session->flash('INVITATION_TO_BID_DELETE_SUCCESS_SLUG', $invitation_to_bid->slug);

    }





}