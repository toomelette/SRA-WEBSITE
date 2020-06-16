<?php
 
namespace App\Core\Services\Guest;

use App\Core\Interfaces\NewsInterface;
use App\Core\Interfaces\AnnouncementInterface;

use App\Core\Interfaces\IndustryStatisticInterface;
use App\Core\Interfaces\ExpiredImportClearanceInterface;

use App\Core\BaseClasses\BaseService;



class HomeService extends BaseService{
	


    protected $news_repo;
    protected $announcement_repo;
    protected $industry_statistic_repo;
    protected $eic_repo;



	public function __construct(NewsInterface $news_repo, AnnouncementInterface $announcement_repo, IndustryStatisticInterface $industry_statistic_repo, ExpiredImportClearanceInterface $eic_repo){

        $this->news_repo = $news_repo;
        $this->announcement_repo = $announcement_repo;
        $this->industry_statistic_repo = $industry_statistic_repo;
        $this->eic_repo = $eic_repo;
        parent::__construct();

    }




    public function contents(){

    	$news_list = $this->news_repo->guestFetchInHome();
        $announcement_list = $this->announcement_repo->guestFetchInHome();

        $industry_statistics = collect($this->industry_statistic_repo->guestFetchForMerge());
        $eic = collect($this->eic_repo->guestFetchForMerge());

        $updates = $industry_statistics->merge($eic);

        // foreach ($updates as $value) {
        //     dd($value);
        // }

        return view('guest.home.index', [
        	'news_list'=> $news_list,
            'announcement_list'=> $announcement_list,
            'updates'=> $updates,
    	]);

    }








}