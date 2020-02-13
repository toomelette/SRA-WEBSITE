<?php
 
namespace App\Core\Services;

use File;
use App\Core\Interfaces\ExpiredImportClearanceInterface;
use App\Core\BaseClasses\BaseService;


class ExpiredImportClearanceService extends BaseService{


    protected $expired_import_clearance_repo;



    public function __construct(ExpiredImportClearanceInterface $expired_import_clearance_repo){

        $this->expired_import_clearance_repo = $expired_import_clearance_repo;
        parent::__construct();

    }





    public function fetch($request){

        $expired_import_clearances = $this->expired_import_clearance_repo->fetch($request);

        $request->flash();
        return view('dashboard.expired_import_clearance.index')->with('expired_import_clearances', $expired_import_clearances);

    }






    public function store($request){

        $file_location = "";

        if(!is_null($request->file('doc_file'))){

            $filename = $this->__dataType::fileFilterReservedChar($request->title .'-'. $this->str->random(8), '.pdf');
            $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/EXPIRED-IMPORT-CLEARANCE';

            $request->file('doc_file')->storeAs($dir, $filename);

            $file_location = $dir .'/'. $filename;

        }

        $expired_import_clearance = $this->expired_import_clearance_repo->store($request, $file_location);
        
        $this->event->fire('expired_import_clearance.store');
        return redirect()->back();
    }







    public function viewFile($slug){

        $expired_import_clearance = $this->expired_import_clearance_repo->findBySlug($slug);

        if(!empty($expired_import_clearance->file_location)){

            $path = $this->__static->archive_dir() .'/'. $expired_import_clearance->file_location;

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

        $expired_import_clearance = $this->expired_import_clearance_repo->findbySlug($slug);
        return view('dashboard.expired_import_clearance.edit')->with('expired_import_clearance', $expired_import_clearance);

    }







    public function update($request, $slug){

        $expired_import_clearance = $this->expired_import_clearance_repo->findbySlug($slug);
        
        $new_filename = $this->__dataType::fileFilterReservedChar($request->title .'-'. $this->str->random(8), '.pdf');
        $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/EXPIRED-IMPORT-CLEARANCE';

        $old_file_location = $expired_import_clearance->file_location;
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
        }elseif($request->title != $expired_import_clearance->title && $this->storage->disk('local')->exists($old_file_location)){
            $this->storage->disk('local')->move($old_file_location, $new_file_location);
            $file_location = $new_file_location;
        }

        $expired_import_clearance = $this->expired_import_clearance_repo->update($request, $file_location, $expired_import_clearance);

        $this->event->fire('expired_import_clearance.update', $expired_import_clearance);
        return redirect()->route('dashboard.expired_import_clearance.index');

    }






    public function destroy($slug){

        $expired_import_clearance = $this->expired_import_clearance_repo->findbySlug($slug);

        if(!is_null($expired_import_clearance->file_location)){

            if ($this->storage->disk('local')->exists($expired_import_clearance->file_location)) {
                $this->storage->disk('local')->delete($expired_import_clearance->file_location);
            }

        }

        $expired_import_clearance = $this->expired_import_clearance_repo->destroy($expired_import_clearance);

        $this->event->fire('expired_import_clearance.destroy', $expired_import_clearance);
        return redirect()->back();

    }






}