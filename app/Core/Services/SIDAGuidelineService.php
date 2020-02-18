<?php
 
namespace App\Core\Services;

use File;
use App\Core\Interfaces\SIDAGuidelineInterface;
use App\Core\BaseClasses\BaseService;


class SIDAGuidelineService extends BaseService{


    protected $sida_guideline_repo;



    public function __construct(SIDAGuidelineInterface $sida_guideline_repo){

        $this->sida_guideline_repo = $sida_guideline_repo;
        parent::__construct();

    }





    public function fetch($request){

        $sida_guidelines = $this->sida_guideline_repo->fetch($request);

        $request->flash();
        return view('dashboard.sida_guideline.index')->with('sida_guidelines', $sida_guidelines);

    }






    public function store($request){

        $file_location = "";

        if(!is_null($request->file('doc_file'))){

            $filename = $this->__dataType::fileFilterReservedChar($request->title .'-'. $this->str->random(8), '.pdf');
            $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/SIDA-GUIDELINE';

            $request->file('doc_file')->storeAs($dir, $filename);

            $file_location = $dir .'/'. $filename;

        }
            

        $sida_guideline = $this->sida_guideline_repo->store($request, $file_location);
        
        $this->event->fire('sida_guideline.store');
        return redirect()->back();
    }







    public function viewFile($slug){

        $sida_guideline = $this->sida_guideline_repo->findBySlug($slug);

        if(!empty($sida_guideline->file_location)){

            $path = $this->__static->archive_dir() .'/'. $sida_guideline->file_location;

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

        $sida_guideline = $this->sida_guideline_repo->findbySlug($slug);
        return view('dashboard.sida_guideline.edit')->with('sida_guideline', $sida_guideline);

    }







    public function update($request, $slug){

        $sida_guideline = $this->sida_guideline_repo->findbySlug($slug);
        
        $new_filename = $this->__dataType::fileFilterReservedChar($request->title .'-'. $this->str->random(8), '.pdf');
        $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/SIDA-GUIDELINE';

        $old_file_location = $sida_guideline->file_location;
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
        }elseif($request->title != $sida_guideline->title && $this->storage->disk('local')->exists($old_file_location)){
            $this->storage->disk('local')->move($old_file_location, $new_file_location);
            $file_location = $new_file_location;
        }

        $sida_guideline = $this->sida_guideline_repo->update($request, $file_location, $sida_guideline);

        $this->event->fire('sida_guideline.update', $sida_guideline);
        return redirect()->route('dashboard.sida_guideline.index');

    }






    public function destroy($slug){

        $sida_guideline = $this->sida_guideline_repo->findbySlug($slug);

        if(!is_null($sida_guideline->file_location)){

            if ($this->storage->disk('local')->exists($sida_guideline->file_location)) {
                $this->storage->disk('local')->delete($sida_guideline->file_location);
            }

        }

        $sida_guideline = $this->sida_guideline_repo->destroy($sida_guideline);

        $this->event->fire('sida_guideline.destroy', $sida_guideline);
        return redirect()->back();

    }






}