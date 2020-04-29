<?php
 
namespace App\Core\Services\Guest;

use App\Core\BaseClasses\BaseService;
use App\Core\Interfaces\TradersDirectoryCategoryInterface;
use App\Core\Interfaces\PlantersDirectoryCategoryInterface;
use App\Core\Interfaces\TradersDirectoryInterface;
use App\Core\Interfaces\PlantersDirectoryInterface;
use File;



class StakeHoldersService extends BaseService{
	


    protected $traders_dir_cat_repo;
    protected $planters_dir_cat_repo;
    protected $traders_dir_repo;
    protected $planters_dir_repo;



	public function __construct(TradersDirectoryCategoryInterface $traders_dir_cat_repo, PlantersDirectoryCategoryInterface $planters_dir_cat_repo, TradersDirectoryInterface $traders_dir_repo, PlantersDirectoryInterface $planters_dir_repo){

        $this->traders_dir_cat_repo = $traders_dir_cat_repo;
        $this->planters_dir_cat_repo = $planters_dir_cat_repo;
        $this->traders_dir_repo = $traders_dir_repo;
        $this->planters_dir_repo = $planters_dir_repo;
        parent::__construct();

    }



    public function list(){

    	$traders_dir_cat_list = $this->traders_dir_cat_repo->getAll();
        $planters_dir_cat_list = $this->planters_dir_cat_repo->getAll();

        return view('guest.stakeholders.index', [
            'traders_dir_cat_list' => $traders_dir_cat_list, 
            'planters_dir_cat_list' => $planters_dir_cat_list
        ]);

    }


    public function viewTradersDirectoryDoc($slug){
        $traders_directory = $this->traders_dir_repo->findBySlug($slug);
        if(!empty($traders_directory->file_location)){
            return $this->view_file('/'. $traders_directory->file_location);
        }
        return abort(404); 
    }


    public function viewPlantersDirectoryDoc($slug){
        $planters_directory = $this->planters_dir_repo->findBySlug($slug);
        if(!empty($planters_directory->file_location)){
            return $this->view_file('/'. $planters_directory->file_location);
        }
        return abort(404); 
    }



    // Utilities
    private function view_file($loc){
        $path = $this->__static->archive_dir() . $loc;
        if (!File::exists($path)){ return abort(404); }
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = response()->make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }








}