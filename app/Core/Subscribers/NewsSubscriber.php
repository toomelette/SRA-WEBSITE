<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class NewsSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('news.store', 'App\Core\Subscribers\NewsSubscriber@onStore');
        $events->listen('news.update', 'App\Core\Subscribers\NewsSubscriber@onUpdate');
        $events->listen('news.destroy', 'App\Core\Subscribers\NewsSubscriber@onDestroy');

    }




    public function onStore(){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:news:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:news:guest:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:news:guest:fetchInHome');

        $this->session->flash('NEWS_CREATE_SUCCESS', 'The News has been successfully created!');

    }



    public function onUpdate($news){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:news:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:news:guest:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:news:guest:fetchInHome');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:news:findBySlug:'. $news->slug .'');

        $this->session->flash('NEWS_UPDATE_SUCCESS', 'The News has been successfully updated!');
        $this->session->flash('NEWS_UPDATE_SUCCESS_SLUG', $news->slug);

    }



    public function onDestroy($news){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:news:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:news:guest:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:news:guest:fetchInHome');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:news:findBySlug:'. $news->slug .'');

        $this->session->flash('NEWS_DELETE_SUCCESS', 'The News has been successfully deleted!');
        $this->session->flash('NEWS_DELETE_SUCCESS_SLUG', $news->slug);

    }





}