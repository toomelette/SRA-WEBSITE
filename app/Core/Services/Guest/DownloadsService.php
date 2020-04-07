<?php
 
namespace App\Core\Services\Guest;
use App\Core\BaseClasses\BaseService;

use App\Core\Interfaces\ApplicationFormInterface;
use File;

class DownloadsService extends BaseService{


    protected $app_form_repo;


    public function __construct(ApplicationFormInterface $app_form_repo){
        $this->app_form_repo = $app_form_repo;
        parent::__construct();
    }


    public function fetchApplicationForms($request){
        $application_forms = $this->app_form_repo->guestFetch($request);    
        return view('guest.downloads.application_forms')->with('application_forms', $application_forms);
    }


    // public function viewAdministratorImg($slug){
    //     $administrator = $this->administrator_repo->findBySlug($slug);
    //     if(!empty($administrator->file_location)){
    //         return $this->view_file('/'. $administrator->file_location);
    //     }
    //     return ''; 
    // }



    // Utilities
    // private function view_file($loc){
    //     $path = $this->__static->archive_dir() . $loc;
    //     if (!File::exists($path)){ return abort(404); }
    //     $file = File::get($path);
    //     $type = File::mimeType($path);
    //     $response = response()->make($file, 200);
    //     $response->header("Content-Type", $type);
    //     return $response;
    // }



}