<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class SMSFormSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('sms_form.store', 'App\Core\Subscribers\SMSFormSubscriber@onStore');
        $events->listen('sms_form.update', 'App\Core\Subscribers\SMSFormSubscriber@onUpdate');
        $events->listen('sms_form.destroy', 'App\Core\Subscribers\SMSFormSubscriber@onDestroy');

    }




    public function onStore(){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sms_forms:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sms_forms:guest:fetch:*');

        $this->session->flash('SMS_FORM_CREATE_SUCCESS', 'The SMS Form has been successfully created!');

    }



    public function onUpdate($sms_form){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:sms_forms:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sms_forms:guest:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sms_forms:findBySlug:'. $sms_form->slug .'');

        $this->session->flash('SMS_FORM_UPDATE_SUCCESS', 'The SMS Form has been successfully updated!');
        $this->session->flash('SMS_FORM_UPDATE_SUCCESS_SLUG', $sms_form->slug);

    }



    public function onDestroy($sms_form){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:sms_forms:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sms_forms:guest:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sms_forms:findBySlug:'. $sms_form->slug .'');

        $this->session->flash('SMS_FORM_DELETE_SUCCESS', 'The SMS Form has been successfully deleted!');
        $this->session->flash('SMS_FORM_DELETE_SUCCESS_SLUG', $sms_form->slug);

    }





}