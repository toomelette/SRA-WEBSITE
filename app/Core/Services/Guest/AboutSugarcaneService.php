<?php
 
namespace App\Core\Services\Guest;
use App\Core\BaseClasses\BaseService;

use App\Core\Interfaces\VarietyInterface;
use App\Core\Interfaces\ResearchInterface;

use File;

class AboutSugarcaneService extends BaseService{


    protected $variety_repo;
    protected $research_repo;


    public function __construct(VarietyInterface $variety_repo, ResearchInterface $research_repo){
        $this->variety_repo = $variety_repo;
        $this->research_repo = $research_repo;
        parent::__construct();
    }


    public function fetchVarieties($request){
        $varieties = $this->variety_repo->guestFetch($request);    
        return view('guest.about_sugarcane.varieties')->with('varieties', $varieties);
    }


    public function viewVarietyImg($slug){
        $varieties = $this->variety_repo->findBySlug($slug);
        if(!empty($varieties->file_location)){
            return $this->view_file('/'. $varieties->file_location);
        }
        return ''; 
    }


    public function fetchResearches($request){
        $researches = $this->research_repo->guestFetch($request);    
        return view('guest.about_sugarcane.researches')->with('researches', $researches);
    }


    public function researchDetails($slug){
        $research = $this->research_repo->findBySlug($slug);
        return view('guest.about_sugarcane.research_details')->with('research', $research);
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