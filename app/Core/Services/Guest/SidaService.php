<?php
 
namespace App\Core\Services\Guest;
use App\Core\BaseClasses\BaseService;

use App\Core\Interfaces\SIDAProgramInterface;
use App\Core\Interfaces\SIDAGuidelineInterface;
use App\Core\Interfaces\SIDALawInterface;
use App\Core\Interfaces\SIDAFundUtilizationInterface;
use File;

class SidaService extends BaseService{



    protected $sida_program_repo;
    protected $sida_guideline_repo;
    protected $sida_law_repo;
    protected $sida_fu_repo;



    public function __construct(SIDAProgramInterface $sida_program_repo, SIDAGuidelineInterface $sida_guideline_repo, SIDALawInterface $sida_law_repo, SIDAFundUtilizationInterface $sida_fu_repo){
        $this->sida_program_repo = $sida_program_repo;
        $this->sida_guideline_repo = $sida_guideline_repo;
        $this->sida_law_repo = $sida_law_repo;
        $this->sida_fu_repo = $sida_fu_repo;
        parent::__construct();
    }



    public function fetchSidaUpdates($request){
        $sida_programs = $this->sida_program_repo->guestFetch($request);    
        return view('guest.sida.sida_updates')->with('sida_programs', $sida_programs);
    }



    public function viewSidaProgramDoc($slug){

        $sida_program = $this->sida_program_repo->findBySlug($slug);

        if (!empty($sida_program->file_location)) {
            $path = $this->__static->archive_dir() .'/'. $sida_program->file_location;
            if (!File::exists($path)){ return abort(404); }
            $file = File::get($path);
            $type = File::mimeType($path);
            $response = response()->make($file, 200);
            $response->header("Content-Type", $type);
            return $response;
        }

    }



    public function fetchSidaGuidelines($request){
        $sida_guidelines = $this->sida_guideline_repo->guestFetch($request);    
        return view('guest.sida.sida_guidelines')->with('sida_guidelines', $sida_guidelines);
    }



    public function viewSidaGuidelineDoc($slug){

        $sida_guideline = $this->sida_guideline_repo->findBySlug($slug);

        if (!empty($sida_guideline->file_location)) {
            $path = $this->__static->archive_dir() .'/'. $sida_guideline->file_location;
            if (!File::exists($path)){ return abort(404); }
            $file = File::get($path);
            $type = File::mimeType($path);
            $response = response()->make($file, 200);
            $response->header("Content-Type", $type);
            return $response;
        }

    }



    public function fetchSidaLaws($request){
        $sida_laws = $this->sida_law_repo->guestFetch($request);    
        return view('guest.sida.sida_laws')->with('sida_laws', $sida_laws);
    }



    public function viewSidaLawDoc($slug){

        $sida_law = $this->sida_law_repo->findBySlug($slug);

        if (!empty($sida_law->file_location)) {
            $path = $this->__static->archive_dir() .'/'. $sida_law->file_location;
            if (!File::exists($path)){ return abort(404); }
            $file = File::get($path);
            $type = File::mimeType($path);
            $response = response()->make($file, 200);
            $response->header("Content-Type", $type);
            return $response;
        }

    }



    public function fetchSidaFU($request){
        $sida_fu_list = $this->sida_fu_repo->guestFetch($request);    
        return view('guest.sida.sida_fu')->with('sida_fu_list', $sida_fu_list);
    }



    public function viewSidaFUDoc($slug){

        $sida_fu = $this->sida_fu_repo->findBySlug($slug);

        if (!empty($sida_fu->file_location)) {
            $path = $this->__static->archive_dir() .'/'. $sida_fu->file_location;
            if (!File::exists($path)){ return abort(404); }
            $file = File::get($path);
            $type = File::mimeType($path);
            $response = response()->make($file, 200);
            $response->header("Content-Type", $type);
            return $response;
        }

    }



}