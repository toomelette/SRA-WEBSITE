<?php

namespace App\Providers;
 
use Illuminate\Support\ServiceProvider;
 

class RepositoryServiceProvider extends ServiceProvider {
	


	public function register(){

		$this->app->bind('App\Core\Interfaces\UserInterface', 'App\Core\Repositories\UserRepository');

		$this->app->bind('App\Core\Interfaces\UserMenuInterface', 'App\Core\Repositories\UserMenuRepository');

		$this->app->bind('App\Core\Interfaces\UserSubmenuInterface', 'App\Core\Repositories\UserSubmenuRepository');


		$this->app->bind('App\Core\Interfaces\MenuInterface', 'App\Core\Repositories\MenuRepository');

		$this->app->bind('App\Core\Interfaces\SubmenuInterface', 'App\Core\Repositories\SubmenuRepository');

		$this->app->bind('App\Core\Interfaces\ProfileInterface', 'App\Core\Repositories\ProfileRepository');



		$this->app->bind('App\Core\Interfaces\NewsInterface', 'App\Core\Repositories\NewsRepository');

		$this->app->bind('App\Core\Interfaces\AnnouncementInterface', 'App\Core\Repositories\AnnouncementRepository');

		$this->app->bind('App\Core\Interfaces\OfficeInterface', 'App\Core\Repositories\OfficeRepository');

		$this->app->bind('App\Core\Interfaces\StationInterface', 'App\Core\Repositories\StationRepository');

		$this->app->bind('App\Core\Interfaces\OfficialInterface', 'App\Core\Repositories\OfficialRepository');

		$this->app->bind('App\Core\Interfaces\AdministratorInterface', 'App\Core\Repositories\AdministratorRepository');

		$this->app->bind('App\Core\Interfaces\HistoricalDataInterface', 'App\Core\Repositories\HistoricalDataRepository');

		$this->app->bind('App\Core\Interfaces\ApplicationFormInterface', 'App\Core\Repositories\ApplicationFormRepository');

		$this->app->bind('App\Core\Interfaces\SMSFormInterface', 'App\Core\Repositories\SMSFormRepository');
		
		
		
	}



}