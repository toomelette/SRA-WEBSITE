<?php

namespace App\Http\Controllers\Guest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Core\Services\Guest\DownloadsService;


class DownloadsController extends Controller{
    

	protected $downloads_service;


    public function __construct(DownloadsService $downloads_service){
        $this->downloads_service = $downloads_service;
    }
   

    public function applicationForms(Request $request){
    	return $this->downloads_service->fetchApplicationForms($request);
    }


}
