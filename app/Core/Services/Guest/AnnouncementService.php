<?php
 
namespace App\Core\Services\Guest;

use App\Core\Interfaces\AnnouncementInterface;
use App\Core\BaseClasses\BaseService;

use File;

class AnnouncementService extends BaseService{
	


    protected $announcement_repo;



	public function __construct(AnnouncementInterface $announcement_repo){

        $this->announcement_repo = $announcement_repo;
        parent::__construct();

    }




    public function list($request){

        $announcement_list = $this->announcement_repo->guestFetch($request);    
        return view('guest.announcement.index')->with('announcement_list', $announcement_list);
        
    }




    public function details($slug){

        $announcement = $this->announcement_repo->findBySlug($slug);    
        return view('guest.announcement.details')->with('announcement', $announcement);
        
    }





    public function viewFile($slug){

        $announcement = $this->announcement_repo->findBySlug($slug);

        if(!empty($announcement->file_location)){
            $path = $this->__static->archive_dir() .'/'. $announcement->file_location;
            if (!File::exists($path)) { return "Cannot Detect File!"; }
            $file = File::get($path);
            $type = File::mimeType($path);
            $response = response()->make($file, 200);
            $response->header("Content-Type", $type);
            return $response;
        }

        return "Cannot Detect File!";

    }




}