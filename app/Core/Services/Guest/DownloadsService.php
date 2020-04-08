<?php
 
namespace App\Core\Services\Guest;
use App\Core\BaseClasses\BaseService;

use App\Core\Interfaces\ApplicationFormInterface;
use App\Core\Interfaces\SMSFormInterface;
use App\Core\Interfaces\HistoricalDataInterface;
use File;

class DownloadsService extends BaseService{


    protected $app_form_repo;
    protected $sms_form_repo;
    protected $historical_data_repo;


    public function __construct(ApplicationFormInterface $app_form_repo, SMSFormInterface $sms_form_repo, HistoricalDataInterface $historical_data_repo){
        $this->app_form_repo = $app_form_repo;
        $this->sms_form_repo = $sms_form_repo;
        $this->historical_data_repo = $historical_data_repo;
        parent::__construct();
    }


    public function fetchApplicationForms($request){
        $application_forms = $this->app_form_repo->guestFetch($request);    
        return view('guest.downloads.application_forms')->with('application_forms', $application_forms);
    }


    public function viewApplicationFormDoc($slug){
        $application_form = $this->app_form_repo->findBySlug($slug);
        if(!empty($application_form->file_location)){
            return $this->view_file('/'. $application_form->file_location);
        }
        return ''; 
    }


    public function fetchSMSForms($request){
        $sms_forms = $this->sms_form_repo->guestFetch($request);    
        return view('guest.downloads.sms_forms')->with('sms_forms', $sms_forms);
    }


    public function viewSMSFormDoc($slug){
        $sms_form = $this->sms_form_repo->findBySlug($slug);
        if(!empty($sms_form->file_location)){
            return $this->view_file('/'. $sms_form->file_location);
        }
        return ''; 
    }


    public function fetchHistoricalData($request){
        $historical_datas = $this->historical_data_repo->guestFetch($request);    
        return view('guest.downloads.historical_data')->with('historical_datas', $historical_datas);
    }


    public function viewHistoricalDataDoc($slug){
        $historical_data = $this->historical_data_repo->findBySlug($slug);
        if(!empty($historical_data->file_location)){
            return $this->view_file('/'. $historical_data->file_location);
        }
        return ''; 
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