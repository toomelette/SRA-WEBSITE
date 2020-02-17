<?php


/** Auth **/
Route::group(['as' => 'auth.'], function () {
	
	Route::get('/', 'Auth\LoginController@showLoginForm')->name('showLogin');
	Route::post('/', 'Auth\LoginController@login')->name('login');
	Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
	Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

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
	
	
	
});






/** Testing **/
// Route::get('/dashboard/test', function(){

// 	return dd(Illuminate\Support\Str::random(16));

// });

