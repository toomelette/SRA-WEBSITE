<?php
 
namespace App\Core\Services\Guest;

use App\Core\Interfaces\NewsInterface;
use App\Core\BaseClasses\BaseService;



class HomeService extends BaseService{
	


    protected $news_repo;



	public function __construct(NewsInterface $news_repo){

        $this->news_repo = $news_repo;
        parent::__construct();

    }




    public function contents(){

    	$news_list = $this->news_repo->guestFetchInHome();

        return view('guest.home.index', [
        	'news_list'=> $news_list,
    	]);

    }








}