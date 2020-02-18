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

		$this->app->bind('App\Core\Interfaces\VarietyInterface', 'App\Core\Repositories\VarietyRepository');

		$this->app->bind('App\Core\Interfaces\VarietyDataInterface', 'App\Core\Repositories\VarietyDataRepository');

		$this->app->bind('App\Core\Interfaces\ResearchInterface', 'App\Core\Repositories\ResearchRepository');

		$this->app->bind('App\Core\Interfaces\TradersDirectoryInterface', 'App\Core\Repositories\TradersDirectoryRepository');

		$this->app->bind('App\Core\Interfaces\TradersDirectoryCategoryInterface', 'App\Core\Repositories\TradersDirectoryCategoryRepository');

		$this->app->bind('App\Core\Interfaces\PlantersDirectoryInterface', 'App\Core\Repositories\PlantersDirectoryRepository');

		$this->app->bind('App\Core\Interfaces\PlantersDirectoryCategoryInterface', 'App\Core\Repositories\PlantersDirectoryCategoryRepository');

		$this->app->bind('App\Core\Interfaces\EventInterface', 'App\Core\Repositories\EventRepository');

		$this->app->bind('App\Core\Interfaces\CropYearInterface', 'App\Core\Repositories\CropYearRepository');

		$this->app->bind('App\Core\Interfaces\IndustryStatisticInterface', 'App\Core\Repositories\IndustryStatisticRepository');

		$this->app->bind('App\Core\Interfaces\IndustryStatisticsCategoryInterface', 'App\Core\Repositories\IndustryStatisticsCategoryRepository');

		$this->app->bind('App\Core\Interfaces\PolicyInterface', 'App\Core\Repositories\PolicyRepository');

		$this->app->bind('App\Core\Interfaces\PolicyCategoryInterface', 'App\Core\Repositories\PolicyCategoryRepository');

		$this->app->bind('App\Core\Interfaces\ExpiredImportClearanceInterface', 'App\Core\Repositories\ExpiredImportClearanceRepository');

		$this->app->bind('App\Core\Interfaces\ExpiredImportClearanceCategoryInterface', 'App\Core\Repositories\ExpiredImportClearanceCategoryRepository');

		$this->app->bind('App\Core\Interfaces\MillingScheduleInterface', 'App\Core\Repositories\MillingScheduleRepository');

		$this->app->bind('App\Core\Interfaces\SIDAProgramInterface', 'App\Core\Repositories\SIDAProgramRepository');

		$this->app->bind('App\Core\Interfaces\BlockFarmInterface', 'App\Core\Repositories\BlockFarmRepository');

		$this->app->bind('App\Core\Interfaces\BioenergyInterface', 'App\Core\Repositories\BioenergyRepository');

		$this->app->bind('App\Core\Interfaces\CropEstimateInterface', 'App\Core\Repositories\CropEstimateRepository');

		$this->app->bind('App\Core\Interfaces\ProvinceInterface', 'App\Core\Repositories\ProvinceRepository');

		$this->app->bind('App\Core\Interfaces\MillDistrictInterface', 'App\Core\Repositories\MillDistrictRepository');

		$this->app->bind('App\Core\Interfaces\SIDAProgramCategoryInterface', 'App\Core\Repositories\SIDAProgramCategoryRepository');

		$this->app->bind('App\Core\Interfaces\SIDAGuidelineInterface', 'App\Core\Repositories\SIDAGuidelineRepository');

		$this->app->bind('App\Core\Interfaces\SIDALawInterface', 'App\Core\Repositories\SIDALawRepository');

		$this->app->bind('App\Core\Interfaces\SIDAFundUtilizationInterface', 'App\Core\Repositories\SIDAFundUtilizationRepository');
		
		$this->app->bind('App\Core\Interfaces\InvitationToBidInterface', 'App\Core\Repositories\InvitationToBidRepository');
		
		
		
	}



}