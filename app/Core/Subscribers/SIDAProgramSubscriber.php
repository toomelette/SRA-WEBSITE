<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class SIDAProgramSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('sida_program.store', 'App\Core\Subscribers\SIDAProgramSubscriber@onStore');
        $events->listen('sida_program.update', 'App\Core\Subscribers\SIDAProgramSubscriber@onUpdate');
        $events->listen('sida_program.destroy', 'App\Core\Subscribers\SIDAProgramSubscriber@onDestroy');

    }




    public function onStore(){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sida_programs:fetch:*');

        $this->session->flash('SIDA_PROGRAM_CREATE_SUCCESS', 'The SIDA Program has been successfully created!');

    }



    public function onUpdate($sida_program){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:sida_programs:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sida_programs:findBySlug:'. $sida_program->slug .'');

        $this->session->flash('SIDA_PROGRAM_UPDATE_SUCCESS', 'The SIDA Program has been successfully updated!');
        $this->session->flash('SIDA_PROGRAM_UPDATE_SUCCESS_SLUG', $sida_program->slug);

    }



    public function onDestroy($sida_program){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:sida_programs:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sida_programs:findBySlug:'. $sida_program->slug .'');

        $this->session->flash('SIDA_PROGRAM_DELETE_SUCCESS', 'The SIDA Program has been successfully deleted!');
        $this->session->flash('SIDA_PROGRAM_DELETE_SUCCESS_SLUG', $sida_program->slug);

    }





}