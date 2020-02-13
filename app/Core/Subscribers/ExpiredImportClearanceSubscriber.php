<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class ExpiredImportClearanceSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('expired_import_clearance.store', 'App\Core\Subscribers\ExpiredImportClearanceSubscriber@onStore');
        $events->listen('expired_import_clearance.update', 'App\Core\Subscribers\ExpiredImportClearanceSubscriber@onUpdate');
        $events->listen('expired_import_clearance.destroy', 'App\Core\Subscribers\ExpiredImportClearanceSubscriber@onDestroy');

    }




    public function onStore(){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:expired_import_clearances:fetch:*');

        $this->session->flash('EXPIRED_IMPORT_CLEARANCE_CREATE_SUCCESS', 'The Expired Import Clearance has been successfully created!');

    }



    public function onUpdate($expired_import_clearance){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:expired_import_clearances:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:expired_import_clearances:findBySlug:'. $expired_import_clearance->slug .'');

        $this->session->flash('EXPIRED_IMPORT_CLEARANCE_UPDATE_SUCCESS', 'The Expired Import Clearance has been successfully updated!');
        $this->session->flash('EXPIRED_IMPORT_CLEARANCE_UPDATE_SUCCESS_SLUG', $expired_import_clearance->slug);

    }



    public function onDestroy($expired_import_clearance){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:expired_import_clearances:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:expired_import_clearances:findBySlug:'. $expired_import_clearance->slug .'');

        $this->session->flash('EXPIRED_IMPORT_CLEARANCE_DELETE_SUCCESS', 'The Expired Import Clearance has been successfully deleted!');
        $this->session->flash('EXPIRED_IMPORT_CLEARANCE_DELETE_SUCCESS_SLUG', $expired_import_clearance->slug);

    }





}