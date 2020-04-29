<?php
 
namespace App\Core\Services\Guest;
use App\Core\BaseClasses\BaseService;

use App\Core\Interfaces\IndustryStatisticInterface;
use App\Core\Interfaces\ExpiredImportClearanceInterface;
use App\Core\Interfaces\MillingScheduleInterface;
use App\Core\Interfaces\BlockFarmInterface;
use App\Core\Interfaces\CropEstimateInterface;
use App\Core\Interfaces\VacantPositionInterface;
use File;

class IndustryUpdateService extends BaseService{


    protected $industry_statistic_repo;
    protected $eic_repo;
    protected $milling_schedule_repo;
    protected $block_farm_repo;
    protected $ces_repo;
    protected $vacant_position_repo;


    public function __construct(IndustryStatisticInterface $industry_statistic_repo, ExpiredImportClearanceInterface $eic_repo, MillingScheduleInterface $milling_schedule_repo, BlockFarmInterface $block_farm_repo, CropEstimateInterface $ces_repo, VacantPositionInterface $vacant_position_repo){
        $this->industry_statistic_repo = $industry_statistic_repo;
        $this->eic_repo = $eic_repo;
        $this->milling_schedule_repo = $milling_schedule_repo;
        $this->block_farm_repo = $block_farm_repo;
        $this->ces_repo = $ces_repo;
        $this->vacant_position_repo = $vacant_position_repo;
        parent::__construct();
    }


    public function fetchSSADS($request){
        $ssads = $this->industry_statistic_repo->guestFetchByCatId('ISC1001', $request);    
        return view('guest.industry_update.ssads')->with('ssads', $ssads);
    }


    public function viewSSADSDoc($slug){
        $ssads = $this->industry_statistic_repo->findBySlug($slug);
        if(!empty($ssads->file_location)){
            return $this->view_file('/'. $ssads->file_location);
        }
        return abort(404);
    }


    public function fetchMillsitePrices($request){
        $millsite_prices = $this->industry_statistic_repo->guestFetchByCatId('ISC1002', $request);    
        return view('guest.industry_update.millsite_prices')->with('millsite_prices', $millsite_prices);
    }


    public function viewMillsitePricesDoc($slug){
        $millsite_prices = $this->industry_statistic_repo->findBySlug($slug);
        if(!empty($millsite_prices->file_location)){
            return $this->view_file('/'. $millsite_prices->file_location);
        }
        return abort(404);
    }


    public function fetchBERPrice($request){
        $ber_price_list = $this->industry_statistic_repo->guestFetchByCatId('ISC1003', $request);    
        return view('guest.industry_update.ber_price')->with('ber_price_list', $ber_price_list);
    }


    public function viewBERPriceDoc($slug){
        $ber_price = $this->industry_statistic_repo->findBySlug($slug);
        if(!empty($ber_price->file_location)){
            return $this->view_file('/'. $ber_price->file_location);
        }
        return abort(404);
    }


    public function fetchMMPrices($request){
        $mm_prices = $this->industry_statistic_repo->guestFetchByCatId('ISC1004', $request);    
        return view('guest.industry_update.mm_prices')->with('mm_prices', $mm_prices);
    }


    public function viewMMPricesDoc($slug){
        $mm_prices = $this->industry_statistic_repo->findBySlug($slug);
        if(!empty($mm_prices->file_location)){
            return $this->view_file('/'. $mm_prices->file_location);
        }
        return abort(404);
    }


    public function fetchSugarStatistics($request){
        $sugar_statistics = $this->industry_statistic_repo->guestFetchByCatId('ISC1005', $request);    
        return view('guest.industry_update.sugar_statistics')->with('sugar_statistics', $sugar_statistics);
    }


    public function viewSugarStatisticsDoc($slug){
        $sugar_statistics = $this->industry_statistic_repo->findBySlug($slug);
        if(!empty($sugar_statistics->file_location)){
            return $this->view_file('/'. $sugar_statistics->file_location);
        }
        return abort(404);
    }


    public function viewRoadmapDoc(){
        return $this->view_file('/STATICS/ROADMAP.PDF');
    }


    public function fetchEIC($request){
        $eic_list = $this->eic_repo->guestFetch($request);    
        return view('guest.industry_update.eic')->with('eic_list', $eic_list);
    }


    public function viewEICDoc($slug){
        $eic = $this->eic_repo->findBySlug($slug);
        if(!empty($eic->file_location)){
            return $this->view_file('/'. $eic->file_location);
        }
        return abort(404);
    }


    public function fetchMillingSchedule($request){
        $milling_schedules = $this->milling_schedule_repo->guestFetch($request);    
        return view('guest.industry_update.milling_schedule')->with('milling_schedules', $milling_schedules);
    }


    public function viewMillingScheduleDoc($slug){
        $milling_schedule = $this->milling_schedule_repo->findBySlug($slug);
        if(!empty($milling_schedule->file_location)){
            return $this->view_file('/'. $milling_schedule->file_location);
        }
        return abort(404);
    }


    public function fetchBlockFarm($request){
        $block_farms = $this->block_farm_repo->guestFetch($request);    
        return view('guest.industry_update.block_farm')->with('block_farms', $block_farms);
    }


    public function viewBlockFarmDoc($slug){
        $block_farm = $this->block_farm_repo->findBySlug($slug);
        if(!empty($block_farm->file_location)){
            return $this->view_file('/'. $block_farm->file_location);
        }
        return abort(404);
    }


    public function fetchCES($request){
        $ces_list = $this->ces_repo->guestFetch($request);    
        return view('guest.industry_update.ces')->with('ces_list', $ces_list);
    }


    public function viewCESDoc($slug){
        $ces = $this->ces_repo->findBySlug($slug);
        if(!empty($ces->file_location)){
            return $this->view_file('/'. $ces->file_location);
        }
        return abort(404);
    }


    public function fetchVacantPosition($request){
        $vacant_positions = $this->vacant_position_repo->guestFetch($request);    
        return view('guest.industry_update.vacant_position')->with('vacant_positions', $vacant_positions);
    }


    public function viewVacantPositionDoc($slug){
        $vacant_position = $this->vacant_position_repo->findBySlug($slug);
        if(!empty($vacant_position->file_location)){
            return $this->view_file('/'. $vacant_position->file_location);
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