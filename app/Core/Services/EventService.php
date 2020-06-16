<?php
 
namespace App\Core\Services;

use File;
use App\Core\Interfaces\EventInterface;
use App\Core\BaseClasses\BaseService;


class EventService extends BaseService{


    protected $event_repo;



    public function __construct(EventInterface $event_repo){

        $this->event_repo = $event_repo;
        parent::__construct();

    }





    public function fetch($request){

        $events = $this->event_repo->fetch($request);

        $request->flash();
        return view('dashboard.event.index')->with('events', $events);

    }






    public function store($request){

        $file_location = "";

        if(!is_null($request->file('doc_file'))){

            $filename = $this->__dataType::fileFilterReservedChar($request->title .'-'. $this->str->random(8), '.pdf');
            $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/EVENTS';

            $request->file('doc_file')->storeAs($dir, $filename);

            $file_location = $dir .'/'. $filename;

        }







          
        $event = $this->event_repo->store($request, $file_location);
        
        $this->event->fire('event.store');
        return redirect()->back();
    }







    public function viewFile($slug){

        $event = $this->event_repo->findBySlug($slug);

        if(!empty($event->file_location)){

            $path = $this->__static->archive_dir() .'/'. $event->file_location;

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

        $event = $this->event_repo->findbySlug($slug);
        return view('dashboard.event.edit')->with('event', $event);

    }







    public function update($request, $slug){

        $event = $this->event_repo->findbySlug($slug);
        
        $new_filename = $this->__dataType::fileFilterReservedChar($request->title .'-'. $this->str->random(8), '.pdf');
        $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/EVENTS';

        $old_file_location = $event->file_location;
        $new_file_location = $dir .'/'. $new_filename;

        $file_location = $old_file_location;

        // if doc_file has value
        if(!is_null($request->file('doc_file'))){

            if ($this->storage->disk('local')->exists($old_file_location)) {
                $this->storage->disk('local')->delete($old_file_location);
            }
            
            $request->file('doc_file')->storeAs($dir, $new_filename);
            $file_location = $new_file_location;
            
        }

        $event = $this->event_repo->update($request, $file_location, $event);

        $this->event->fire('event.update', $event);
        return redirect()->route('dashboard.event.index');

    }






    public function destroy($slug){

        $event = $this->event_repo->findbySlug($slug);

        if(!is_null($event->file_location)){

            if ($this->storage->disk('local')->exists($event->file_location)) {
                $this->storage->disk('local')->delete($event->file_location);
            }

        }

        $event = $this->event_repo->destroy($event);

        $this->event->fire('event.destroy', $event);
        return redirect()->back();

    }






}