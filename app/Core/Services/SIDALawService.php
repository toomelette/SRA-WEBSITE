<?php
 
namespace App\Core\Services;

use File;
use App\Core\Interfaces\SIDALawInterface;
use App\Core\BaseClasses\BaseService;


class SIDALawService extends BaseService{


    protected $sida_law_repo;



    public function __construct(SIDALawInterface $sida_law_repo){

        $this->sida_law_repo = $sida_law_repo;
        parent::__construct();

    }





    public function fetch($request){

        $sida_laws = $this->sida_law_repo->fetch($request);

        $request->flash();
        return view('dashboard.sida_law.index')->with('sida_laws', $sida_laws);

    }






    public function store($request){

        $file_location = "";

        if(!is_null($request->file('doc_file'))){

            $filename = $this->__dataType::fileFilterReservedChar($request->title .'-'. $this->str->random(8), '.pdf');
            $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/SIDA-LAW';

            $request->file('doc_file')->storeAs($dir, $filename);

            $file_location = $dir .'/'. $filename;

        }
            

        $sida_law = $this->sida_law_repo->store($request, $file_location);
        
        $this->event->fire('sida_law.store');
        return redirect()->back();
    }







    public function viewFile($slug){

        $sida_law = $this->sida_law_repo->findBySlug($slug);

        if(!empty($sida_law->file_location)){

            $path = $this->__static->archive_dir() .'/'. $sida_law->file_location;

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

        $sida_law = $this->sida_law_repo->findbySlug($slug);
        return view('dashboard.sida_law.edit')->with('sida_law', $sida_law);

    }







    public function update($request, $slug){

        $sida_law = $this->sida_law_repo->findbySlug($slug);
        
        $new_filename = $this->__dataType::fileFilterReservedChar($request->title .'-'. $this->str->random(8), '.pdf');
        $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/SIDA-LAW';

        $old_file_location = $sida_law->file_location;
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
        }elseif($request->title != $sida_law->title && $this->storage->disk('local')->exists($old_file_location)){
            $this->storage->disk('local')->move($old_file_location, $new_file_location);
            $file_location = $new_file_location;
        }

        $sida_law = $this->sida_law_repo->update($request, $file_location, $sida_law);

        $this->event->fire('sida_law.update', $sida_law);
        return redirect()->route('dashboard.sida_law.index');

    }






    public function destroy($slug){

        $sida_law = $this->sida_law_repo->findbySlug($slug);

        if(!is_null($sida_law->file_location)){

            if ($this->storage->disk('local')->exists($sida_law->file_location)) {
                $this->storage->disk('local')->delete($sida_law->file_location);
            }

        }

        $sida_law = $this->sida_law_repo->destroy($sida_law);

        $this->event->fire('sida_law.destroy', $sida_law);
        return redirect()->back();

    }






}