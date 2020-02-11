<?php
 
namespace App\Core\Services;

use File;
use App\Core\Interfaces\TradersDirectoryInterface;
use App\Core\BaseClasses\BaseService;


class TradersDirectoryService extends BaseService{


    protected $traders_directory_repo;



    public function __construct(TradersDirectoryInterface $traders_directory_repo){

        $this->traders_directory_repo = $traders_directory_repo;
        parent::__construct();

    }





    public function fetch($request){

        $traders_directories = $this->traders_directory_repo->fetch($request);

        $request->flash();
        return view('dashboard.traders_directory.index')->with('traders_directories', $traders_directories);

    }






    public function store($request){

        $file_location = "";

        if(!is_null($request->file('doc_file'))){

            $filename = $this->__dataType::fileFilterReservedChar($request->title .'-'. $this->str->random(8), '.pdf');
            $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/TRADERS-DIRECTORY';

            $request->file('doc_file')->storeAs($dir, $filename);

            $file_location = $dir .'/'. $filename;

        }
            

        $traders_directory = $this->traders_directory_repo->store($request, $file_location);
        
        $this->event->fire('traders_directory.store');
        return redirect()->back();
    }







    public function viewFile($slug){

        $traders_directory = $this->traders_directory_repo->findBySlug($slug);

        if(!empty($traders_directory->file_location)){

            $path = $this->__static->archive_dir() .'/'. $traders_directory->file_location;

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

        $traders_directory = $this->traders_directory_repo->findbySlug($slug);
        return view('dashboard.traders_directory.edit')->with('traders_directory', $traders_directory);

    }







    public function update($request, $slug){

        $traders_directory = $this->traders_directory_repo->findbySlug($slug);
        
        $new_filename = $this->__dataType::fileFilterReservedChar($request->title .'-'. $this->str->random(8), '.pdf');
        $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/TRADERS-DIRECTORY';

        $old_file_location = $traders_directory->file_location;
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
        }elseif($request->title != $traders_directory->title && $this->storage->disk('local')->exists($old_file_location)){
            $this->storage->disk('local')->move($old_file_location, $new_file_location);
            $file_location = $new_file_location;
        }

        $traders_directory = $this->traders_directory_repo->update($request, $file_location, $traders_directory);

        $this->event->fire('traders_directory.update', $traders_directory);
        return redirect()->route('dashboard.traders_directory.index');

    }






    public function destroy($slug){

        $traders_directory = $this->traders_directory_repo->findbySlug($slug);

        if(!is_null($traders_directory->file_location)){

            if ($this->storage->disk('local')->exists($traders_directory->file_location)) {
                $this->storage->disk('local')->delete($traders_directory->file_location);
            }

        }

        $traders_directory = $this->traders_directory_repo->destroy($traders_directory);

        $this->event->fire('traders_directory.destroy', $traders_directory);
        return redirect()->back();

    }






}