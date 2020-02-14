<?php 

namespace App\Core\Subscribers;


use App\Core\BaseClasses\BaseSubscriber;



class BlockFarmSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('block_farm.store', 'App\Core\Subscribers\BlockFarmSubscriber@onStore');
        $events->listen('block_farm.update', 'App\Core\Subscribers\BlockFarmSubscriber@onUpdate');
        $events->listen('block_farm.destroy', 'App\Core\Subscribers\BlockFarmSubscriber@onDestroy');

    }




    public function onStore(){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:block_farms:fetch:*');

        $this->session->flash('BLOCK_FARM_CREATE_SUCCESS', 'The Block Farm has been successfully created!');

    }



    public function onUpdate($block_farm){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:block_farms:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:block_farms:findBySlug:'. $block_farm->slug .'');

        $this->session->flash('BLOCK_FARM_UPDATE_SUCCESS', 'The Block Farm has been successfully updated!');
        $this->session->flash('BLOCK_FARM_UPDATE_SUCCESS_SLUG', $block_farm->slug);

    }



    public function onDestroy($block_farm){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:block_farms:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:block_farms:findBySlug:'. $block_farm->slug .'');

        $this->session->flash('BLOCK_FARM_DELETE_SUCCESS', 'The Block Farm has been successfully deleted!');
        $this->session->flash('BLOCK_FARM_DELETE_SUCCESS_SLUG', $block_farm->slug);

    }





}