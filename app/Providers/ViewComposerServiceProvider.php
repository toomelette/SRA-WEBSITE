<?php

namespace App\Providers;


use View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider{

    
    public function boot(){

        /** VIEW COMPOSERS  **/


        // USERMENU
        View::composer('layouts.admin-sidenav', 'App\Core\ViewComposers\UserMenuComposer');


        // MENU
        View::composer(['dashboard.user.create', 
                        'dashboard.user.edit'], 'App\Core\ViewComposers\MenuComposer');
        

        // SUBMENU
        View::composer(['dashboard.user.create', 
                        'dashboard.user.edit'], 'App\Core\ViewComposers\SubmenuComposer');
        

        // OFFICES
        View::composer(['dashboard.official.create', 
                        'dashboard.official.edit'], 'App\Core\ViewComposers\OfficeComposer');
        

        // STATIONS
        View::composer(['dashboard.official.create', 
                        'dashboard.official.edit'], 'App\Core\ViewComposers\StationComposer');

        
    }

    




    
    public function register(){

      


    
    }




}
