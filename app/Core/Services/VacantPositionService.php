<?php
 
namespace App\Core\Services;

use File;
use App\Core\Interfaces\VacantPositionInterface;
use App\Core\BaseClasses\BaseService;


class VacantPositionService extends BaseService{


    protected $vacant_position_repo;



    public function __construct(VacantPositionInterface $vacant_position_repo){

        $this->vacant_position_repo = $vacant_position_repo;
        parent::__construct();

    }





    public function fetch($request){

        $vacant_positions = $this->vacant_position_repo->fetch($request);

        $request->flash();
        return view('dashboard.vacant_position.index')->with('vacant_positions', $vacant_positions);

    }






    public function store($request){

        $file_location = "";

        if(!is_null($request->file('doc_file'))){

            $filename = $this->__dataType::fileFilterReservedChar($request->title .'-'. $this->str->random(8), '.pdf');
            $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/VACANT-POSITIONS';

            $request->file('doc_file')->storeAs($dir, $filename);

            $file_location = $dir .'/'. $filename;

        }
            

        $vacant_position = $this->vacant_position_repo->store($request, $file_location);
        
        $this->event->fire('vacant_position.store');
        return redirect()->back();
    }







    public function viewFile($slug){

        $vacant_position = $this->vacant_position_repo->findBySlug($slug);

        if(!empty($vacant_position->file_location)){

            $path = $this->__static->archive_dir() .'/'. $vacant_position->file_location;

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

        $vacant_position = $this->vacant_position_repo->findbySlug($slug);
        return view('dashboard.vacant_position.edit')->with('vacant_position', $vacant_position);

    }







    public function update($request, $slug){

        $vacant_position = $this->vacant_position_repo->findbySlug($slug);
        
        $new_filename = $this->__dataType::fileFilterReservedChar($request->title .'-'. $this->str->random(8), '.pdf');
        $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/VACANT-POSITIONS';

        $old_file_location = $vacant_position->file_location;
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
        }elseif($request->title != $vacant_position->title && $this->storage->disk('local')->exists($old_file_location)){
            $this->storage->disk('local')->move($old_file_location, $new_file_location);
            $file_location = $new_file_location;
        }

        $vacant_position = $this->vacant_position_repo->update($request, $file_location, $vacant_position);

        $this->event->fire('vacant_position.update', $vacant_position);
        return redirect()->route('dashboard.vacant_position.index');

    }






    public function destroy($slug){

        $vacant_position = $this->vacant_position_repo->findbySlug($slug);

        if(!is_null($vacant_position->file_location)){
            if ($this->storage->disk('local')->exists($vacant_position->file_location)) {
                $this->storage->disk('local')->delete($vacant_position->file_location);
            }
        }

        $vacant_position = $this->vacant_position_repo->destroy($vacant_position);

        $this->event->fire('vacant_position.destroy', $vacant_position);
        return redirect()->back();

    }






}