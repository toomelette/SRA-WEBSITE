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
                        'dashboard.official.edit',
                        'dashboard.event.create',
                        'dashboard.event.edit',], 'App\Core\ViewComposers\StationComposer');
        

        // TRADER DIRECTORY CATEGORY
        View::composer(['dashboard.traders_directory.create', 
                        'dashboard.traders_directory.edit'], 'App\Core\ViewComposers\TradersDirectoryCategoryComposer');
        

        // PLANTER DIRECTORY CATEGORY
        View::composer(['dashboard.planters_directory.create', 
                        'dashboard.planters_directory.edit'], 'App\Core\ViewComposers\PlantersDirectoryCategoryComposer');
        

        // CROP YEAR
        View::composer(['dashboard.industry_statistic.create', 
                        'dashboard.industry_statistic.edit',
                        'dashboard.policy.create',
                        'dashboard.policy.edit'], 'App\Core\ViewComposers\CropYearComposer');
        

        // INDUSTRY STATISTICS
        View::composer(['dashboard.industry_statistic.create', 
                        'dashboard.industry_statistic.edit'], 'App\Core\ViewComposers\IndustryStatisticsCategoryComposer');
        

        // POLICY CATEGORY
        View::composer(['dashboard.policy.create', 
                        'dashboard.policy.edit'], 'App\Core\ViewComposers\PolicyCategoryComposer');
        

        // Expired Import Clearance Category
        View::composer(['dashboard.expired_import_clearance.create', 
                        'dashboard.expired_import_clearance.edit'], 'App\Core\ViewComposers\ExpiredImportClearanceCategoryComposer');
        

        // Province
        View::composer(['dashboard.sida_program.create', 
                        'dashboard.sida_program.edit', 
                        'dashboard.mill_district.create', 
                        'dashboard.mill_district.edit'], 'App\Core\ViewComposers\ProvinceComposer');
        

        // Mill District
        View::composer(['dashboard.sida_program.create', 
                        'dashboard.sida_program.edit'], 'App\Core\ViewComposers\MillDistrictComposer');
        

        // SIDA Program Category
        View::composer(['dashboard.sida_program.create', 
                        'dashboard.sida_program.edit'], 'App\Core\ViewComposers\SIDAProgramCategoryComposer');


        
    }

    




    
    public function register(){

      


    
    }




}
