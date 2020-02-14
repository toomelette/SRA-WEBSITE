<?php
 
namespace App\Core\Services;

use File;
use App\Core\Interfaces\BioenergyInterface;
use App\Core\BaseClasses\BaseService;


class BioenergyService extends BaseService{


    protected $bioenergy_repo;



    public function __construct(BioenergyInterface $bioenergy_repo){

        $this->bioenergy_repo = $bioenergy_repo;
        parent::__construct();

    }





    public function fetch($request){

        $bioenergy = $this->bioenergy_repo->fetch($request);

        $request->flash();
        return view('dashboard.bioenergy.index')->with('bioenergy', $bioenergy);

    }






    public function store($request){

        $file_location = "";

        if(!is_null($request->file('doc_file'))){

            $filename = $this->__dataType::fileFilterReservedChar($request->title .'-'. $this->str->random(8), '.pdf');
            $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/BIOENERGY';

            $request->file('doc_file')->storeAs($dir, $filename);

            $file_location = $dir .'/'. $filename;

        }
            

        $bioenergy = $this->bioenergy_repo->store($request, $file_location);
        
        $this->event->fire('bioenergy.store');
        return redirect()->back();
    }







    public function viewFile($slug){

        $bioenergy = $this->bioenergy_repo->findBySlug($slug);

        if(!empty($bioenergy->file_location)){

            $path = $this->__static->archive_dir() .'/'. $bioenergy->file_location;

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

        $bioenergy = $this->bioenergy_repo->findbySlug($slug);
        return view('dashboard.bioenergy.edit')->with('bioenergy', $bioenergy);

    }







    public function update($request, $slug){

        $bioenergy = $this->bioenergy_repo->findbySlug($slug);
        
        $new_filename = $this->__dataType::fileFilterReservedChar($request->title .'-'. $this->str->random(8), '.pdf');
        $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/BIOENERGY';

        $old_file_location = $bioenergy->file_location;
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
        }elseif($request->title != $bioenergy->title && $this->storage->disk('local')->exists($old_file_location)){
            $this->storage->disk('local')->move($old_file_location, $new_file_location);
            $file_location = $new_file_location;
        }

        $bioenergy = $this->bioenergy_repo->update($request, $file_location, $bioenergy);

        $this->event->fire('bioenergy.update', $bioenergy);
        return redirect()->route('dashboard.bioenergy.index');

    }






    public function destroy($slug){

        $bioenergy = $this->bioenergy_repo->findbySlug($slug);

        if(!is_null($bioenergy->file_location)){

            if ($this->storage->disk('local')->exists($bioenergy->file_location)) {
                $this->storage->disk('local')->delete($bioenergy->file_location);
            }

        }

        $bioenergy = $this->bioenergy_repo->destroy($bioenergy);

        $this->event->fire('bioenergy.destroy', $bioenergy);
        return redirect()->back();

    }






}