<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider{


   
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
    ];




    public function boot(){

        parent::boot();

    }




    protected $subscribe = [

        'App\Core\Subscribers\UserSubscriber',
        'App\Core\Subscribers\ProfileSubscriber',
        'App\Core\Subscribers\MenuSubscriber',
        'App\Core\Subscribers\NewsSubscriber',
        'App\Core\Subscribers\AnnouncementSubscriber',
        'App\Core\Subscribers\OfficeSubscriber',
        'App\Core\Subscribers\OfficialSubscriber',
        'App\Core\Subscribers\AdministratorSubscriber',
        'App\Core\Subscribers\HistoricalDataSubscriber',
        'App\Core\Subscribers\ApplicationFormSubscriber',
        'App\Core\Subscribers\SMSFormSubscriber',
        'App\Core\Subscribers\VarietySubscriber',
        'App\Core\Subscribers\ResearchSubscriber',
        'App\Core\Subscribers\TradersDirectorySubscriber',
        'App\Core\Subscribers\PlantersDirectorySubscriber',
        'App\Core\Subscribers\EventSubscriber',
        
    ];





}
