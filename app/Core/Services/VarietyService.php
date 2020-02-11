<?php
 
namespace App\Core\Services;

use File;
use App\Core\Interfaces\VarietyInterface;
use App\Core\Interfaces\VarietyDataInterface;
use App\Core\BaseClasses\BaseService;


class VarietyService extends BaseService{


    protected $variety_repo;
    protected $variety_data_repo;



    public function __construct(VarietyInterface $variety_repo, VarietyDataInterface $variety_data_repo){

        $this->variety_repo = $variety_repo;
        $this->variety_data_repo = $variety_data_repo;
        parent::__construct();

    }





    public function fetch($request){

        $varieties = $this->variety_repo->fetch($request);

        $request->flash();
        return view('dashboard.variety.index')->with('varieties', $varieties);

    }






    public function store($request){

        $file_location = "";

        if(!is_null($request->file('doc_file'))){

            $filename = $this->__dataType::fileFilterReservedChar($request->name .'-'. $this->str->random(8), '.jpg');
            $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/VARIETY';

            $request->file('doc_file')->storeAs($dir, $filename);

            $file_location = $dir .'/'. $filename;

        }

        $variety = $this->variety_repo->store($request, $file_location);
        
        if(!empty($request->row)){
            foreach ($request->row as $row) {
                $variety_data = $this->variety_data_repo->store($row, $variety);
            }
        }

        $this->event->fire('variety.store');
        return redirect()->back();
    }







    public function viewImg($slug){

        $variety = $this->variety_repo->findBySlug($slug);

        if(!empty($variety->file_location)){

            $path = $this->__static->archive_dir() .'/'. $variety->file_location;

            if (!File::exists($path)) { return "Cannot Detect File!"; }

            $file = File::get($path);
            $type = File::mimeType($path);

            $response = response()->make($file, 200);
            $response->header("Content-Type", $type);

            return $response;

        }

        return "Cannot Detect File!";;
        

    }
    






    public function show($slug){

        $variety = $this->variety_repo->findbySlug($slug);
        return view('dashboard.variety.show')->with('variety', $variety);

    }






    public function edit($slug){

        $variety = $this->variety_repo->findbySlug($slug);
        return view('dashboard.variety.edit')->with('variety', $variety);

    }







    public function update($request, $slug){

        $variety = $this->variety_repo->findbySlug($slug);
        
        $new_filename = $this->__dataType::fileFilterReservedChar($request->name .'-'. $this->str->random(8), '.jpg');
        $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/VARIETY';

        $old_file_location = $variety->file_location;
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
        }elseif($request->name != $variety->name && $this->storage->disk('local')->exists($old_file_location)){
            $this->storage->disk('local')->move($old_file_location, $new_file_location);
            $file_location = $new_file_location;
        }

        $variety = $this->variety_repo->update($request, $file_location, $variety);

        if(!empty($request->row)){
            foreach ($request->row as $row) {
                $variety_data = $this->variety_data_repo->store($row, $variety);
            }
        }

        $this->event->fire('variety.update', $variety);
        return redirect()->route('dashboard.variety.index');

    }






    public function destroy($slug){

        $variety = $this->variety_repo->findbySlug($slug);

        if(!is_null($variety->file_location)){

            if ($this->storage->disk('local')->exists($variety->file_location)) {
                $this->storage->disk('local')->delete($variety->file_location);
            }

        }

        $variety = $this->variety_repo->destroy($variety);

        $this->event->fire('variety.destroy', $variety);
        return redirect()->back();

    }






}