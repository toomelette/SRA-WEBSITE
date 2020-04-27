<?php
 
namespace App\Core\Services\Guest;
use App\Core\BaseClasses\BaseService;

use App\Core\Interfaces\SIDAProgramInterface;
use File;

class SidaService extends BaseService{


    protected $sida_program_repo;


    public function __construct(SIDAProgramInterface $sida_program_repo){
        $this->sida_program_repo = $sida_program_repo;
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



}