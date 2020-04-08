<?php

namespace App\Http\Controllers\Guest;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApplicationForm\GuestApplicationFormFilterRequest;
use App\Http\Requests\SMSForm\GuestSMSFormFilterRequest;
use App\Http\Requests\HistoricalData\GuestHistoricalDataFilterRequest;
use App\Core\Services\Guest\DownloadsService;


class DownloadsController extends Controller{
    

	protected $downloads_service;


    public function __construct(DownloadsService $downloads_service){
        $this->downloads_service = $downloads_service;
    }
   

    public function applicationForms(GuestApplicationFormFilterRequest $request){
    	return $this->downloads_service->fetchApplicationForms($request);
    }

   
    public function viewApplicationFormDoc($slug){
    	return $this->downloads_service->viewApplicationFormDoc($slug);
    }
   

    public function smsForms(GuestSMSFormFilterRequest $request){
    	return $this->downloads_service->fetchSMSForms($request);
    }

   
    public function viewSMSFormDoc($slug){
    	return $this->downloads_service->viewSMSFormDoc($slug);
    }
   

    public function historicalData(GuestHistoricalDataFilterRequest $request){
    	return $this->downloads_service->fetchHistoricalData($request);
    }


}
