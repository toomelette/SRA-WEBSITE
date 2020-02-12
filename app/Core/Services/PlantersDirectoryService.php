<?php
 
namespace App\Core\Services;

use File;
use App\Core\Interfaces\PlantersDirectoryInterface;
use App\Core\BaseClasses\BaseService;


class PlantersDirectoryService extends BaseService{


    protected $planters_directory_repo;



    public function __construct(PlantersDirectoryInterface $planters_directory_repo){

        $this->planters_directory_repo = $planters_directory_repo;
        parent::__construct();

    }





    public function fetch($request){

        $planters_directories = $this->planters_directory_repo->fetch($request);

        $request->flash();
        return view('dashboard.planters_directory.index')->with('planters_directories', $planters_directories);

    }






    public function store($request){

        $file_location = "";

        if(!is_null($request->file('doc_file'))){

            $filename = $this->__dataType::fileFilterReservedChar($request->title .'-'. $this->str->random(8), '.pdf');
            $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/PLANTERS-DIRECTORY';

            $request->file('doc_file')->storeAs($dir, $filename);

            $file_location = $dir .'/'. $filename;

        }
            

        $planters_directory = $this->planters_directory_repo->store($request, $file_location);
        
        $this->event->fire('planters_directory.store');
        return redirect()->back();
    }







    public function viewFile($slug){

        $planters_directory = $this->planters_directory_repo->findBySlug($slug);

        if(!empty($planters_directory->file_location)){

            $path = $this->__static->archive_dir() .'/'. $planters_directory->file_location;

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

        $planters_directory = $this->planters_directory_repo->findbySlug($slug);
        return view('dashboard.planters_directory.edit')->with('planters_directory', $planters_directory);

    }







    public function update($request, $slug){

        $planters_directory = $this->planters_directory_repo->findbySlug($slug);
        
        $new_filename = $this->__dataType::fileFilterReservedChar($request->title .'-'. $this->str->random(8), '.pdf');
        $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/PLANTERS-DIRECTORY';

        $old_file_location = $planters_directory->file_location;
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
        }elseif($request->title != $planters_directory->title && $this->storage->disk('local')->exists($old_file_location)){
            $this->storage->disk('local')->move($old_file_location, $new_file_location);
            $file_location = $new_file_location;
        }

        $planters_directory = $this->planters_directory_repo->update($request, $file_location, $planters_directory);

        $this->event->fire('planters_directory.update', $planters_directory);
        return redirect()->route('dashboard.planters_directory.index');

    }






    public function destroy($slug){

        $planters_directory = $this->planters_directory_repo->findbySlug($slug);

        if(!is_null($planters_directory->file_location)){

            if ($this->storage->disk('local')->exists($planters_directory->file_location)) {
                $this->storage->disk('local')->delete($planters_directory->file_location);
            }

        }

        $planters_directory = $this->planters_directory_repo->destroy($planters_directory);

        $this->event->fire('planters_directory.destroy', $planters_directory);
        return redirect()->back();

    }






}