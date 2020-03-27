<?php
 
namespace App\Core\Services\Guest;

use App\Core\Interfaces\NewsInterface;
use App\Core\Interfaces\AnnouncementInterface;
use App\Core\BaseClasses\BaseService;



class HomeService extends BaseService{
	


    protected $news_repo;
    protected $announcement_repo;



	public function __construct(NewsInterface $news_repo, AnnouncementInterface $announcement_repo){

        $this->news_repo = $news_repo;
        $this->announcement_repo = $announcement_repo;
        parent::__construct();

    }




    public function contents(){

    	$news_list = $this->news_repo->guestFetchInHome();
        $announcement_list = $this->announcement_repo->guestFetchInHome();

        return view('guest.home.index', [
        	'news_list'=> $news_list,
            'announcement_list'=> $announcement_list,
    	]);

    }








}