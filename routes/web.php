<?php



/** Auth **/
Route::group(['prefix'=>'login', 'as' => 'auth.'], function () {
	Route::get('/', 'Auth\LoginController@showLoginForm')->name('showLogin');
	Route::post('/', 'Auth\LoginController@login')->name('login');
	Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
	Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
});



/** Guest **/
Route::group(['as' => 'guest.'], function () {
	
	Route::get('/', 'Guest\HomeController@index')->name('home.index');

	// News
	Route::get('/news', 'Guest\NewsController@index')->name('news.index');
	Route::get('/news/details/{slug}', 'Guest\NewsController@details')->name('news.details');
	Route::get('/news/view_file/{slug}', 'Guest\NewsController@viewFile')->name('news.view_file');
	Route::get('/news/view_img/{slug}', 'Guest\NewsController@viewImg')->name('news.view_img');

	// Announcement
	Route::get('/announcement', 'Guest\AnnouncementController@index')->name('announcement.index');
	Route::get('/announcement/details/{slug}', 'Guest\AnnouncementController@details')->name('announcement.details');
	Route::get('/announcement/view_file/{slug}', 'Guest\AnnouncementController@viewFile')->name('announcement.view_file');

	// About Us
	Route::get('/about_us/mandate', 'Guest\AboutUsController@mandate')->name('about_us.mandate');

	Route::get('/about_us/services', 'Guest\AboutUsController@services')->name('about_us.services');
	Route::get('/about_us/services/view_service_guide/{slug}', 'Guest\AboutUsController@viewServiceGuide')->name('about_us.view_service_guide');
	Route::get('/about_us/services/view_service_fees', 'Guest\AboutUsController@viewServiceFees')->name('about_us.view_service_fees');

	Route::get('/about_us/charter', 'Guest\AboutUsController@charter')->name('about_us.charter');
	Route::get('/about_us/charter/view_eo', 'Guest\AboutUsController@viewCharterEO')->name('about_us.view_charter_eo');

	Route::get('/about_us/org_chart', 'Guest\AboutUsController@orgChart')->name('about_us.org_chart');
	Route::get('/about_us/view_org_chart_img', 'Guest\AboutUsController@viewOrgChartImg')->name('about_us.view_org_chart_img');
	Route::get('/about_us/view_org_functional_statements', 'Guest\AboutUsController@viewOrgFunctionalStatements')->name('about_us.view_org_functional_statements');

	Route::get('/about_us/corp_objectives', 'Guest\AboutUsController@corpObjectives')->name('about_us.corp_objectives');

	Route::get('/about_us/history', 'Guest\AboutUsController@history')->name('about_us.history');

	Route::get('/about_us/officials', 'Guest\AboutUsController@officials')->name('about_us.officials');
	Route::get('/about_us/officials/view_img/{slug}', 'Guest\AboutUsController@viewOfficialImg')->name('about_us.view_official_img');

	Route::get('/about_us/administrators', 'Guest\AboutUsController@administrators')->name('about_us.administrators');
	Route::get('/about_us/administrators/view_img/{slug}', 'Guest\AboutUsController@viewAdministratorImg')->name('about_us.view_administrator_img');

	// Downloads
	Route::get('/downloads/application_forms', 'Guest\DownloadsController@applicationForms')->name('downloads.application_forms');
	Route::get('/downloads/application_forms/view_doc/{slug}', 'Guest\DownloadsController@viewApplicationFormDoc')->name('downloads.view_application_form_doc');

	Route::get('/downloads/sms_forms', 'Guest\DownloadsController@smsForms')->name('downloads.sms_forms');
	Route::get('/downloads/sms_forms/view_doc/{slug}', 'Guest\DownloadsController@viewSMSFormDoc')->name('downloads.view_sms_form_doc');

	Route::get('/downloads/historical_data', 'Guest\DownloadsController@historicalData')->name('downloads.historical_data');
	Route::get('/downloads/historical_data/view_doc/{slug}', 'Guest\DownloadsController@viewHistoricalDataDoc')->name('downloads.view_historical_data_doc');

	// About Sugar Cane
	Route::get('/about_sugarcane/sugarcane_varieties', 'Guest\AboutSugarcaneController@varieties')->name('about_sugarcane.varieties');
	Route::get('/about_sugarcane/sugarcane_varieties/view_img/{slug}', 'Guest\AboutSugarcaneController@viewVarietyImg')->name('about_sugarcane.view_variety_img');

	Route::get('/about_sugarcane/researches', 'Guest\AboutSugarcaneController@researches')->name('about_sugarcane.researches');
	Route::get('/about_sugarcane/researches/{slug}', 'Guest\AboutSugarcaneController@researchDetails')->name('about_sugarcane.research_details');

	// Stakeholders
	Route::get('/stakeholders', 'Guest\StakeholdersController@index')->name('stakeholders.index');
	Route::get('/stakeholders/traders_directory/view_doc/{slug}', 'Guest\StakeholdersController@viewTradersDirectoryDoc')->name('stakeholders.view_traders_directory_doc');
	Route::get('/stakeholders/planters_directory/view_doc/{slug}', 'Guest\StakeholdersController@viewPlantersDirectoryDoc')->name('stakeholders.view_planters_directory_doc');

	// Industry Update
	Route::get('/industry_update/ssads', 'Guest\IndustryUpdateController@ssads')->name('industry_update.ssads');
	Route::get('/industry_update/ssads/view_doc/{slug}', 'Guest\IndustryUpdateController@viewSSADSDoc')->name('industry_update.view_ssads_doc');

	Route::get('/industry_update/millsite_prices', 'Guest\IndustryUpdateController@millsitePrices')->name('industry_update.millsite_prices');
	Route::get('/industry_update/millsite_prices/view_doc/{slug}', 'Guest\IndustryUpdateController@viewMillsitePricesDoc')->name('industry_update.view_millsite_prices_doc');

	Route::get('/industry_update/ber_price', 'Guest\IndustryUpdateController@BERPrice')->name('industry_update.ber_price');
	Route::get('/industry_update/ber_price/view_doc/{slug}', 'Guest\IndustryUpdateController@viewBERPriceDoc')->name('industry_update.view_ber_price_doc');

	Route::get('/industry_update/mm_prices', 'Guest\IndustryUpdateController@MMPrices')->name('industry_update.mm_prices');
	Route::get('/industry_update/mm_prices/view_doc/{slug}', 'Guest\IndustryUpdateController@viewMMPricesDoc')->name('industry_update.view_mm_prices_doc');

	Route::get('/industry_update/sugar_statistics', 'Guest\IndustryUpdateController@sugarStatistics')->name('industry_update.sugar_statistics');
	Route::get('/industry_update/sugar_statistics/view_doc/{slug}', 'Guest\IndustryUpdateController@viewSugarStatisticsDoc')->name('industry_update.view_sugar_statistics_doc');

	Route::get('/industry_update/roadmap', 'Guest\IndustryUpdateController@roadmap')->name('industry_update.roadmap');
	Route::get('/industry_update/roadmap/view_doc/', 'Guest\IndustryUpdateController@viewRoadmapDoc')->name('industry_update.view_roadmap_doc');

	Route::get('/industry_update/eic', 'Guest\IndustryUpdateController@EIC')->name('industry_update.eic');
	Route::get('/industry_update/eic/view_doc/{slug}', 'Guest\IndustryUpdateController@viewEICDoc')->name('industry_update.view_eic_doc');

	Route::get('/industry_update/milling_schedule', 'Guest\IndustryUpdateController@millingSchedule')->name('industry_update.milling_schedule');
	Route::get('/industry_update/milling_schedule/view_doc/{slug}', 'Guest\IndustryUpdateController@viewMillingScheduleDoc')->name('industry_update.view_milling_schedule_doc');

	Route::get('/industry_update/block_farm', 'Guest\IndustryUpdateController@blockFarm')->name('industry_update.block_farm');
	Route::get('/industry_update/block_farm/view_doc/{slug}', 'Guest\IndustryUpdateController@viewBlockFarmDoc')->name('industry_update.view_block_farm_doc');

	Route::get('/industry_update/ces', 'Guest\IndustryUpdateController@CES')->name('industry_update.ces');
	Route::get('/industry_update/ces/view_doc/{slug}', 'Guest\IndustryUpdateController@viewCESDoc')->name('industry_update.view_ces_doc');

	Route::get('/industry_update/vacant_position', 'Guest\IndustryUpdateController@vacantPosition')->name('industry_update.vacant_position');
	Route::get('/industry_update/vacant_position/view_doc/{slug}', 'Guest\IndustryUpdateController@viewVacantPositionDoc')->name('industry_update.view_vacant_position_doc');

	// Policies
	Route::get('/policies/sugar_order', 'Guest\PoliciesController@sugarOrder')->name('policies.sugar_order');
	Route::get('/policies/sugar_order/view_doc/{slug}', 'Guest\PoliciesController@viewPolicyDoc')->name('policies.view_sugar_order_doc');

	Route::get('/policies/circular_letter', 'Guest\PoliciesController@circularLetter')->name('policies.circular_letter');
	Route::get('/policies/circular_letter/view_doc/{slug}', 'Guest\PoliciesController@viewPolicyDoc')->name('policies.view_circular_letter_doc');

	Route::get('/policies/memo_order', 'Guest\PoliciesController@memoOrder')->name('policies.memo_order');
	Route::get('/policies/memo_order/view_doc/{slug}', 'Guest\PoliciesController@viewPolicyDoc')->name('policies.view_memo_order_doc');

	Route::get('/policies/memo_cir', 'Guest\PoliciesController@memoCir')->name('policies.memo_cir');
	Route::get('/policies/memo_cir/view_doc/{slug}', 'Guest\PoliciesController@viewPolicyDoc')->name('policies.view_memo_cir_doc');

	Route::get('/policies/molasses_order', 'Guest\PoliciesController@molassesOrder')->name('policies.molasses_order');
	Route::get('/policies/molasses_order/view_doc/{slug}', 'Guest\PoliciesController@viewPolicyDoc')->name('policies.view_molasses_order_doc');

	Route::get('/policies/muscovado_order', 'Guest\PoliciesController@muscovadoOrder')->name('policies.muscovado_order');
	Route::get('/policies/muscovado_order/view_doc/{slug}', 'Guest\PoliciesController@viewPolicyDoc')->name('policies.view_muscovado_order_doc');

	Route::get('/policies/ga_order', 'Guest\PoliciesController@GAOrder')->name('policies.ga_order');
	Route::get('/policies/ga_order/view_doc/{slug}', 'Guest\PoliciesController@viewPolicyDoc')->name('policies.view_ga_order_doc');

	Route::get('/policies/sugar_law', 'Guest\PoliciesController@sugarLaw')->name('policies.sugar_law');
	Route::get('/policies/sugar_law/view_doc/{slug}', 'Guest\PoliciesController@viewPolicyDoc')->name('policies.view_sugar_law_doc');

	Route::get('/policies/bioenergy', 'Guest\PoliciesController@bioenergy')->name('policies.bioenergy');
	Route::get('/policies/bioenergy/view_doc/{slug}', 'Guest\PoliciesController@viewPolicyDoc')->name('policies.view_bioenergy_doc');

	Route::get('/policies/asean', 'Guest\PoliciesController@asean')->name('policies.asean');
	Route::get('/policies/asean/view_doc/{slug}', 'Guest\PoliciesController@viewPolicyDoc')->name('policies.view_asean_doc');

	// SIDA
	Route::get('/sida/sida_updates', 'Guest\SidaController@sidaUpdates')->name('sida.sida_updates');
	Route::get('/sida/sida_updates/view_doc/{slug}', 'Guest\SidaController@viewSidaProgramDoc')->name('sida.view_sida_program_doc');

	Route::get('/sida/sida_guideline', 'Guest\SidaController@sidaGuidelines')->name('sida.sida_guideline');
	Route::get('/sida/sida_guideline/view_doc/{slug}', 'Guest\SidaController@viewSidaGuidelineDoc')->name('sida.view_sida_guideline_doc');

	Route::get('/sida/sida_law', 'Guest\SidaController@sidaLaws')->name('sida.sida_law');
	Route::get('/sida/sida_law/view_doc/{slug}', 'Guest\SidaController@viewSidaLawDoc')->name('sida.view_sida_law_doc');

	Route::get('/sida/sida_fu', 'Guest\SidaController@sidaFU')->name('sida.sida_fu');
	Route::get('/sida/sida_fu/viedocg/{slug}', 'Guest\SidaController@viewSidaFUDoc')->name('sida.view_sida_fu_doc');

	// BID
	Route::get('/bid_corner/itb', 'Guest\BidController@ITB')->name('bid.itb');
	Route::get('/bid_corner/itb/view_itb/{slug}', 'Guest\BidController@viewITB')->name('bid.view_itb');
	Route::get('/bid_corner/itb/view_pbd/{slug}', 'Guest\BidController@viewPBD')->name('bid.view_pbd');

	Route::get('/bid_corner/supplemental_bid', 'Guest\BidController@suppBid')->name('bid.supp_bid');
	Route::get('/bid_corner/supplemental_bid/view_supp_bid/{slug}', 'Guest\BidController@viewSuppBid')->name('bid.view_supp_bid');

	Route::get('/bid_corner/noa', 'Guest\BidController@NOA')->name('bid.noa');
	Route::get('/bid_corner/noa/view_noa/{slug}', 'Guest\BidController@viewNOA')->name('bid.view_noa');
	Route::get('/bid_corner/noa/view_bacreso/{slug}', 'Guest\BidController@viewBacReso')->name('bid.view_bacreso');

	Route::get('/bid_corner/ntp', 'Guest\BidController@NTP')->name('bid.ntp');
	Route::get('/bid_corner/ntp/view_ntp/{slug}', 'Guest\BidController@viewNTP')->name('bid.view_ntp');
	Route::get('/bid_corner/ntp/view_po/{slug}', 'Guest\BidController@viewPO')->name('bid.view_po');

	Route::get('/bid_corner/philgeps_posting', 'Guest\BidController@philgepsPosting')->name('bid.philgeps_posting');

	Route::get('/bid_corner/mob', 'Guest\BidController@MOB')->name('bid.mob');
	Route::get('/bid_corner/mob/view_mob/{slug}', 'Guest\BidController@viewMOB')->name('bid.view_mob');


});



/** Dashboard **/
Route::group(['prefix'=>'dashboard', 'as' => 'dashboard.', 'middleware' => ['check.user_status', 'check.user_route']], function () {

	/** HOME **/	
	Route::get('/home', 'HomeController@index')->name('home');

	/** USER **/   
	Route::post('/user/activate/{slug}', 'UserController@activate')->name('user.activate');
	Route::post('/user/deactivate/{slug}', 'UserController@deactivate')->name('user.deactivate');
	Route::post('/user/logout/{slug}', 'UserController@logout')->name('user.logout');
	Route::get('/user/{slug}/reset_password', 'UserController@resetPassword')->name('user.reset_password');
	Route::patch('/user/reset_password/{slug}', 'UserController@resetPasswordPost')->name('user.reset_password_post');
	Route::resource('user', 'UserController');

	/** PROFILE **/
	Route::get('/profile', 'ProfileController@details')->name('profile.details');
	Route::patch('/profile/update_account_username/{slug}', 'ProfileController@updateAccountUsername')->name('profile.update_account_username');
	Route::patch('/profile/update_account_password/{slug}', 'ProfileController@updateAccountPassword')->name('profile.update_account_password');
	Route::patch('/profile/update_account_color/{slug}', 'ProfileController@updateAccountColor')->name('profile.update_account_color');

	/** MENU **/
	Route::resource('menu', 'MenuController');

	/** NEWS **/
	Route::get('/news/view_file/{slug}', 'NewsController@viewFile')->name('news.view_file');
	Route::get('/news/view_img/{slug}', 'NewsController@viewImg')->name('news.view_img');
	Route::resource('news', 'NewsController');

	/** ANNOUNCEMENTS **/
	Route::get('/announcement/view_file/{slug}', 'AnnouncementController@viewFile')->name('announcement.view_file');
	Route::resource('announcement', 'AnnouncementController');

	/** OFFICES **/
	Route::resource('office', 'OfficeController');

	/** OFFICIALS **/
	Route::get('/official/view_avatar/{slug}', 'OfficialController@viewAvatar')->name('official.view_avatar');
	Route::resource('official', 'OfficialController');

	/** ADMINISTRATORS **/
	Route::get('/administrator/view_avatar/{slug}', 'AdministratorController@viewAvatar')->name('administrator.view_avatar');
	Route::resource('administrator', 'AdministratorController');

	/** Historical Data **/
	Route::get('/historical_data/view_file/{slug}', 'HistoricalDataController@viewFile')->name('historical_data.view_file');
	Route::resource('historical_data', 'HistoricalDataController');

	/** Application Forms **/
	Route::get('/application_form/view_file/{slug}', 'ApplicationFormController@viewFile')->name('application_form.view_file');
	Route::resource('application_form', 'ApplicationFormController');

	/** SMS Forms **/
	Route::get('/sms_form/view_file/{slug}', 'SMSFormController@viewFile')->name('sms_form.view_file');
	Route::resource('sms_form', 'SMSFormController');

	/** Variety **/
	Route::get('/variety/view_img/{slug}', 'VarietyController@viewImg')->name('variety.view_img');
	Route::resource('variety', 'VarietyController');

	/** Researches **/
	Route::resource('research', 'ResearchController');

	/** Traders Directory **/
	Route::get('/traders_directory/view_file/{slug}', 'TradersDirectoryController@viewFile')->name('traders_directory.view_file');
	Route::resource('traders_directory', 'TradersDirectoryController');

	/** Planters Directory **/
	Route::get('/planters_directory/view_file/{slug}', 'PlantersDirectoryController@viewFile')->name('planters_directory.view_file');
	Route::resource('planters_directory', 'PlantersDirectoryController');

	/** Events **/
	Route::get('/event/view_file/{slug}', 'EventController@viewFile')->name('event.view_file');
	Route::resource('event', 'EventController');

	/** Industry Statistic **/
	Route::get('/industry_statistic/view_file/{slug}', 'IndustryStatisticController@viewFile')->name('industry_statistic.view_file');
	Route::resource('industry_statistic', 'IndustryStatisticController');

	/** POLICIES **/
	Route::get('/policy/view_file/{slug}', 'PolicyController@viewFile')->name('policy.view_file');
	Route::resource('policy', 'PolicyController');

	/** Expired Import Clearance **/
	Route::get('/expired_import_clearance/view_file/{slug}', 'ExpiredImportClearanceController@viewFile')->name('expired_import_clearance.view_file');
	Route::resource('expired_import_clearance', 'ExpiredImportClearanceController');

	/** Milling Schedule **/
	Route::get('/milling_schedule/view_file/{slug}', 'MillingScheduleController@viewFile')->name('milling_schedule.view_file');
	Route::resource('milling_schedule', 'MillingScheduleController');

	/** Vacant Positions **/
	Route::get('/vacant_position/view_file/{slug}', 'VacantPositionController@viewFile')->name('vacant_position.view_file');
	Route::resource('vacant_position', 'VacantPositionController');
	
	/** SIDA Programs **/
	Route::get('/sida_program/view_file/{slug}', 'SIDAProgramController@viewFile')->name('sida_program.view_file');
	Route::resource('sida_program', 'SIDAProgramController');
	
	/** Block Farms **/
	Route::get('/block_farm/view_file/{slug}', 'BlockFarmController@viewFile')->name('block_farm.view_file');
	Route::resource('block_farm', 'BlockFarmController');
	
	/** BIOENERGY **/
	Route::get('/bioenergy/view_file/{slug}', 'BioenergyController@viewFile')->name('bioenergy.view_file');
	Route::resource('bioenergy', 'BioenergyController');
	
	/** Crop Estimates **/
	Route::get('/crop_estimate/view_file/{slug}', 'CropEstimateController@viewFile')->name('crop_estimate.view_file');
	Route::resource('crop_estimate', 'CropEstimateController');

	/** Province **/
	Route::resource('province', 'ProvinceController');

	/** Mill Districts **/
	Route::resource('mill_district', 'MillDistrictController');
	
	/** SIDA Program Categories **/
	Route::resource('sida_program_category', 'SIDAProgramCategoryController');
	
	/** SIDA Guidelines **/
	Route::get('/sida_guideline/view_file/{slug}', 'SIDAGuidelineController@viewFile')->name('sida_guideline.view_file');
	Route::resource('sida_guideline', 'SIDAGuidelineController');
	
	/** SIDA Law **/
	Route::get('/sida_law/view_file/{slug}', 'SIDALawController@viewFile')->name('sida_law.view_file');
	Route::resource('sida_law', 'SIDALawController');
	
	/** SIDA Fund Utilization **/
	Route::get('/sida_fund_utilization/view_file/{slug}', 'SIDAFundUtilizationController@viewFile')->name('sida_fund_utilization.view_file');
	Route::resource('sida_fund_utilization', 'SIDAFundUtilizationController');
	
	/** Invitation to Bid **/
	Route::get('/invitation_to_bid/view_file/{slug}/{type}', 'InvitationToBidController@viewFile')->name('invitation_to_bid.view_file');
	Route::resource('invitation_to_bid', 'InvitationToBidController');
	
	/**Supplemental Bid **/
	Route::get('/supplemental_bid/view_file/{slug}', 'SupplementalBidController@viewFile')->name('supplemental_bid.view_file');
	Route::resource('supplemental_bid', 'SupplementalBidController');
	
	/** Notice of Award **/
	Route::get('/notice_of_award/view_file/{slug}/{type}', 'NoticeOfAwardController@viewFile')->name('notice_of_award.view_file');
	Route::resource('notice_of_award', 'NoticeOfAwardController');
	
	/** Notice to Proceed **/
	Route::get('/notice_to_proceed/view_file/{slug}/{type}', 'NoticeToProceedController@viewFile')->name('notice_to_proceed.view_file');
	Route::resource('notice_to_proceed', 'NoticeToProceedController');
	
	/** Minutes of the Bid **/
	Route::get('/minutes_of_the_bid/view_file/{slug}', 'MinutesOfTheBidController@viewFile')->name('minutes_of_the_bid.view_file');
	Route::resource('minutes_of_the_bid', 'MinutesOfTheBidController');
	
	/** Admin Corner **/
	Route::get('/admin_corner/view_img/{slug}', 'AdminCornerController@viewImg')->name('admin_corner.view_img');
	Route::resource('admin_corner', 'AdminCornerController');
	
});





/** Testing **/
// Route::get('/dashboard/test', function(){

// 	return dd(Illuminate\Support\Str::random(16));

// });

