<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class SIDAProgramCategorySubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('sida_program_category.store', 'App\Core\Subscribers\SIDAProgramCategorySubscriber@onStore');
        $events->listen('sida_program_category.update', 'App\Core\Subscribers\SIDAProgramCategorySubscriber@onUpdate');
        $events->listen('sida_program_category.destroy', 'App\Core\Subscribers\SIDAProgramCategorySubscriber@onDestroy');

    }




    public function onStore(){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sida_program_categories:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sida_program_categories:getAll');

        $this->session->flash('SIDA_PROGRAM_CATEGORY_CREATE_SUCCESS', 'The SIDA Program Category has been successfully created!');

    }



    public function onUpdate($sida_program_category){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:sida_program_categories:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sida_program_categories:getAll');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sida_program_categories:findBySlug:'. $sida_program_category->slug .'');

        $this->session->flash('SIDA_PROGRAM_CATEGORY_UPDATE_SUCCESS', 'The SIDA Program Category has been successfully updated!');
        $this->session->flash('SIDA_PROGRAM_CATEGORY_UPDATE_SUCCESS_SLUG', $sida_program_category->slug);

    }



    public function onDestroy($sida_program_category){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:sida_program_categories:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sida_program_categories:getAll');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:sida_program_categories:findBySlug:'. $sida_program_category->slug .'');

        $this->session->flash('SIDA_PROGRAM_CATEGORY_DELETE_SUCCESS', 'The SIDA Program Category has been successfully deleted!');
        $this->session->flash('SIDA_PROGRAM_CATEGORY_DELETE_SUCCESS_SLUG', $sida_program_category->slug);

    }





}