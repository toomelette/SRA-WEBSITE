<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class ApplicationFormSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('application_form.store', 'App\Core\Subscribers\ApplicationFormSubscriber@onStore');
        $events->listen('application_form.update', 'App\Core\Subscribers\ApplicationFormSubscriber@onUpdate');
        $events->listen('application_form.destroy', 'App\Core\Subscribers\ApplicationFormSubscriber@onDestroy');

    }




    public function onStore(){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:application_forms:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:application_forms:guest:fetch:*');

        $this->session->flash('APPLICATION_FORM_CREATE_SUCCESS', 'The Application Form has been successfully created!');

    }



    public function onUpdate($application_form){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:application_forms:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:application_forms:guest:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:application_forms:findBySlug:'. $application_form->slug .'');

        $this->session->flash('APPLICATION_FORM_UPDATE_SUCCESS', 'The Application Form has been successfully updated!');
        $this->session->flash('APPLICATION_FORM_UPDATE_SUCCESS_SLUG', $application_form->slug);

    }



    public function onDestroy($application_form){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:application_forms:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:application_forms:guest:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:application_forms:findBySlug:'. $application_form->slug .'');

        $this->session->flash('APPLICATION_FORM_DELETE_SUCCESS', 'The Application Form has been successfully deleted!');
        $this->session->flash('APPLICATION_FORM_DELETE_SUCCESS_SLUG', $application_form->slug);

    }





}