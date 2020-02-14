<?php
 
namespace App\Core\Services;

use File;
use App\Core\Interfaces\MillingScheduleInterface;
use App\Core\BaseClasses\BaseService;


class MillingScheduleService extends BaseService{


    protected $milling_schedule_repo;



    public function __construct(MillingScheduleInterface $milling_schedule_repo){

        $this->milling_schedule_repo = $milling_schedule_repo;
        parent::__construct();

    }





    public function fetch($request){

        $milling_schedules = $this->milling_schedule_repo->fetch($request);

        $request->flash();
        return view('dashboard.milling_schedule.index')->with('milling_schedules', $milling_schedules);

    }






    public function store($request){

        $file_location = "";

        if(!is_null($request->file('doc_file'))){

            $filename = $this->__dataType::fileFilterReservedChar($request->title .'-'. $this->str->random(8), '.pdf');
            $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/MILLING-SCHEDULE';

            $request->file('doc_file')->storeAs($dir, $filename);

            $file_location = $dir .'/'. $filename;

        }
            

        $milling_schedule = $this->milling_schedule_repo->store($request, $file_location);
        
        $this->event->fire('milling_schedule.store');
        return redirect()->back();
    }







    public function viewFile($slug){

        $milling_schedule = $this->milling_schedule_repo->findBySlug($slug);

        if(!empty($milling_schedule->file_location)){

            $path = $this->__static->archive_dir() .'/'. $milling_schedule->file_location;

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

        $milling_schedule = $this->milling_schedule_repo->findbySlug($slug);
        return view('dashboard.milling_schedule.edit')->with('milling_schedule', $milling_schedule);

    }







    public function update($request, $slug){

        $milling_schedule = $this->milling_schedule_repo->findbySlug($slug);
        
        $new_filename = $this->__dataType::fileFilterReservedChar($request->title .'-'. $this->str->random(8), '.pdf');
        $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/MILLING-SCHEDULE';

        $old_file_location = $milling_schedule->file_location;
        $new_file_location = $dir .'/'. $new_filename;

        $file_location = $old_file_location;

        // if doc_file has value
        if(!is_null($request->file('doc_file'))){

            if ($this->storage->disk('local')->exists($old_file_location)) {
                $this->storage->disk('local')->delete($old_file_location);
            }
            
            $request->file('doc_file')->storeAs($dir, $new_filename);
            $file_location = $new_file_location;

        // if title has change
        }elseif($request->title != $milling_schedule->title && $this->storage->disk('local')->exists($old_file_location)){
            $this->storage->disk('local')->move($old_file_location, $new_file_location);
            $file_location = $new_file_location;
        }

        $milling_schedule = $this->milling_schedule_repo->update($request, $file_location, $milling_schedule);

        $this->event->fire('milling_schedule.update', $milling_schedule);
        return redirect()->route('dashboard.milling_schedule.index');

    }






    public function destroy($slug){

        $milling_schedule = $this->milling_schedule_repo->findbySlug($slug);

        if(!is_null($milling_schedule->file_location)){

            if ($this->storage->disk('local')->exists($milling_schedule->file_location)) {
                $this->storage->disk('local')->delete($milling_schedule->file_location);
            }

        }

        $milling_schedule = $this->milling_schedule_repo->destroy($milling_schedule);

        $this->event->fire('milling_schedule.destroy', $milling_schedule);
        return redirect()->back();

    }






}