<?php
 
namespace App\Core\Services;

use File;
use App\Core\Interfaces\AnnouncementInterface;
use App\Core\BaseClasses\BaseService;


class AnnouncementService extends BaseService{


    protected $announcement_repo;



    public function __construct(AnnouncementInterface $announcement_repo){

        $this->announcement_repo = $announcement_repo;
        parent::__construct();

    }





    public function fetch($request){

        $announcements = $this->announcement_repo->fetch($request);

        $request->flash();
        return view('dashboard.announcement.index')->with('announcements', $announcements);

    }






    public function store($request){

        $file_location = "";

        if ($request->type == "FILE") {

            $filename = $this->__dataType::fileFilterReservedChar($request->title .'-'. $this->str->random(8), '.pdf');
            $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/ANNOUNCEMENTS';

            if(!is_null($request->file('doc_file'))){
                $request->file('doc_file')->storeAs($dir, $filename);
            }
            
            $file_location = $dir .'/'. $filename;
        
        }

        $announcement = $this->announcement_repo->store($request, $file_location);
        
        $this->event->fire('announcement.store');
        return redirect()->back();

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

        return "Cannot Detect File!";;
        

    }






    public function edit($slug){

        $announcement = $this->announcement_repo->findbySlug($slug);
        return view('dashboard.announcement.edit')->with('announcement', $announcement);

    }






    public function show($slug){

        $announcement = $this->announcement_repo->findbySlug($slug);
        return view('dashboard.announcement.show')->with('announcement', $announcement);

    }






    public function update($request, $slug){

        $announcement = $this->announcement_repo->findbySlug($slug);
        
        $new_filename = $this->__dataType::fileFilterReservedChar($request->title .'-'. $this->str->random(8), '.pdf');
        $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/ANNOUNCEMENTS';

        $old_file_location = $announcement->file_location;
        $new_file_location = $dir .'/'. $new_filename;

        $file_location = $old_file_location;

        if ($request->type == "FILE") {

            // if doc_file has value
            if(!is_null($request->file('doc_file'))){

                if ($this->storage->disk('local')->exists($old_file_location)) {
                    $this->storage->disk('local')->delete($old_file_location);
                }
                
                $request->file('doc_file')->storeAs($dir, $new_filename);
                $file_location = $new_file_location;

            // if title has change
            }elseif($request->title != $announcement->title && $this->storage->disk('local')->exists($old_file_location)){
                $this->storage->disk('local')->move($old_file_location, $new_file_location);
                $file_location = $new_file_location;
            }
            
        }elseif($request->type == "URL"){

            if(isset($announcement->file_location)){

                if ($this->storage->disk('local')->exists($old_file_location)) {
                    $this->storage->disk('local')->delete($old_file_location);
                }

            }

        }

        $announcement = $this->announcement_repo->update($request, $file_location, $announcement);

        $this->event->fire('announcement.update', $announcement);
        return redirect()->route('dashboard.announcement.index');

    }






    public function destroy($slug){

        $announcement = $this->announcement_repo->findbySlug($slug);

        if(!is_null($announcement->file_location)){

            if ($this->storage->disk('local')->exists($announcement->file_location)) {
                $this->storage->disk('local')->delete($announcement->file_location);
            }

        }

        $announcement = $this->announcement_repo->destroy($announcement);

        $this->event->fire('announcement.destroy', $announcement);
        return redirect()->back();

    }






}