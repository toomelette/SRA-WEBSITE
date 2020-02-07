<?php
 
namespace App\Core\Services;

use File;
use App\Core\Interfaces\OfficialInterface;
use App\Core\BaseClasses\BaseService;


class OfficialService extends BaseService{


    protected $official_repo;



    public function __construct(OfficialInterface $official_repo){

        $this->official_repo = $official_repo;
        parent::__construct();

    }





    public function fetch($request){

        $officials = $this->official_repo->fetch($request);

        $request->flash();
        return view('dashboard.official.index')->with('officials', $officials);

    }






    public function store($request){

        $file_location = "";

        if(!is_null($request->file('doc_file'))){

            $filename = $this->__dataType::fileFilterReservedChar($request->fullname .'-'. $this->str->random(8), '.jpg');
            $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/OFFICIALS';

            $request->file('doc_file')->storeAs($dir, $filename);

            $file_location = $dir .'/'. $filename;

        }
            

        $official = $this->official_repo->store($request, $file_location);
        
        $this->event->fire('official.store');
        return redirect()->back();

    }







    public function viewAvatar($slug){

        $official = $this->official_repo->findBySlug($slug);

        if(!empty($official->file_location)){

            $path = $this->__static->archive_dir() .'/'. $official->file_location;

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

        $official = $this->official_repo->findbySlug($slug);
        return view('dashboard.official.edit')->with('official', $official);

    }






    public function show($slug){

        $official = $this->official_repo->findbySlug($slug);
        return view('dashboard.official.show')->with('official', $official);

    }






    public function update($request, $slug){

        $official = $this->official_repo->findbySlug($slug);
        
        $new_filename = $this->__dataType::fileFilterReservedChar($request->fullname .'-'. $this->str->random(8), '.jpg');
        $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/OFFICIALS';

        $old_file_location = $official->file_location;
        $new_file_location = $dir .'/'. $new_filename;

        $file_location = $old_file_location;

        // if doc_file has value
        if(!is_null($request->file('doc_file'))){

            if ($this->storage->disk('local')->exists($old_file_location)) {
                $this->storage->disk('local')->delete($old_file_location);
            }
            
            $request->file('doc_file')->storeAs($dir, $new_filename);
            $file_location = $new_file_location;

        // if fullname has change
        }elseif($request->fullname != $official->fullname && $this->storage->disk('local')->exists($old_file_location)){
            $this->storage->disk('local')->move($old_file_location, $new_file_location);
            $file_location = $new_file_location;
        }

        $official = $this->official_repo->update($request, $file_location, $official);

        $this->event->fire('official.update', $official);
        return redirect()->route('dashboard.official.index');

    }






    public function destroy($slug){

        $official = $this->official_repo->findbySlug($slug);

        if(!is_null($official->file_location)){

            if ($this->storage->disk('local')->exists($official->file_location)) {
                $this->storage->disk('local')->delete($official->file_location);
            }

        }

        $official = $this->official_repo->destroy($official);

        $this->event->fire('official.destroy', $official);
        return redirect()->back();

    }






}