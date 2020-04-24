<?php

namespace App\Http\Controllers\Guest;
use App\Http\Controllers\Controller;

use App\Http\Requests\IndustryStatistic\GuestSSADSFilterRequest;
use App\Http\Requests\IndustryStatistic\GuestMillsitePricesFilterRequest;
use App\Http\Requests\IndustryStatistic\GuestBERPriceFilterRequest;
use App\Http\Requests\IndustryStatistic\GuestMMPricesFilterRequest;
use App\Http\Requests\IndustryStatistic\GuestSugarStatisticsFilterRequest;

use App\Http\Requests\ExpiredImportClearance\GuestEICFilterRequest;
use App\Http\Requests\MillingSchedule\GuestMillingScheduleFilterRequest;
use App\Http\Requests\BlockFarm\GuestBlockFarmFilterRequest;
use App\Http\Requests\CropEstimate\GuestCESFilterRequest;
use App\Http\Requests\VacantPosition\GuestVacantPositionFilterRequest;

use App\Core\Services\Guest\IndustryUpdateService;


class IndustryUpdateController extends Controller{
    

    protected $industry_update;


    public function __construct(IndustryUpdateService $industry_update){
        $this->industry_update = $industry_update;
    }
   

    public function ssads(GuestSSADSFilterRequest $request){
        return $this->industry_update->fetchSSADS($request);
    }
   

    public function viewSSADSDoc($slug){
        return $this->industry_update->viewSSADSDoc($slug);
    }
   

    public function millsitePrices(GuestMillsitePricesFilterRequest $request){
        return $this->industry_update->fetchMillsitePrices($request);
    }
   

    public function viewMillsitePricesDoc($slug){
        return $this->industry_update->viewMillsitePricesDoc($slug);
    }
   

    public function BERPrice(GuestBERPriceFilterRequest $request){
        return $this->industry_update->fetchBERPrice($request);
    }
   

    public function viewBERPriceDoc($slug){
        return $this->industry_update->viewBERPriceDoc($slug);
    }
   

    public function MMPrices(GuestMMPricesFilterRequest $request){
        return $this->industry_update->fetchMMPrices($request);
    }
   

    public function viewMMPricesDoc($slug){
        return $this->industry_update->viewMMPricesDoc($slug);
    }

   
    public function sugarStatistics(GuestSugarStatisticsFilterRequest $request){
        return $this->industry_update->fetchSugarStatistics($request);
    }
   

    public function viewSugarStatisticsDoc($slug){
        return $this->industry_update->viewSugarStatisticsDoc($slug);
    }
   

    public function roadmap(){
        return view('guest.industry_update.roadmap');
    }
   

    public function viewRoadmapDoc(){
        return $this->industry_update->viewRoadmapDoc();
    }
   

    public function EIC(GuestEICFilterRequest $request){
        return $this->industry_update->fetchEIC($request);
    }
   

    public function viewEICDoc($slug){
        return $this->industry_update->viewEICDoc($slug);
    }
   

    public function millingSchedule(GuestMillingScheduleFilterRequest $request){
        return $this->industry_update->fetchMillingSchedule($request);
    }
   

    public function viewMillingScheduleDoc($slug){
        return $this->industry_update->viewMillingScheduleDoc($slug);
    }
   

    public function blockFarm(GuestBlockFarmFilterRequest $request){
        return $this->industry_update->fetchBlockFarm($request);
    }
   

    public function viewBlockFarmDoc($slug){
        return $this->industry_update->viewBlockFarmDoc($slug);
    }
   

    public function CES(GuestCESFilterRequest $request){
        return $this->industry_update->fetchCES($request);
    }
   

    public function viewCESDoc($slug){
        return $this->industry_update->viewCESDoc($slug);
    }
   

    public function vacantPosition(GuestVacantPositionFilterRequest $request){
        return $this->industry_update->fetchVacantPosition($request);
    }
   

    public function viewVacantPositionDoc($slug){
        return $this->industry_update->viewVacantPositionDoc($slug);
    }




}
