<?php
 
namespace App\Core\Services;

use File;
use App\Core\Interfaces\CropEstimateInterface;
use App\Core\BaseClasses\BaseService;


class CropEstimateService extends BaseService{


    protected $crop_estimate_repo;



    public function __construct(CropEstimateInterface $crop_estimate_repo){

        $this->crop_estimate_repo = $crop_estimate_repo;
        parent::__construct();

    }





    public function fetch($request){

        $crop_estimates = $this->crop_estimate_repo->fetch($request);

        $request->flash();
        return view('dashboard.crop_estimate.index')->with('crop_estimates', $crop_estimates);

    }






    public function store($request){

        $file_location = "";

        if(!is_null($request->file('doc_file'))){

            $filename = $this->__dataType::fileFilterReservedChar($request->title .'-'. $this->str->random(8), '.pdf');
            $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/CROP-ESTIMATE';

            $request->file('doc_file')->storeAs($dir, $filename);

            $file_location = $dir .'/'. $filename;

        }
            

        $crop_estimate = $this->crop_estimate_repo->store($request, $file_location);
        
        $this->event->fire('crop_estimate.store');
        return redirect()->back();
    }







    public function viewFile($slug){

        $crop_estimate = $this->crop_estimate_repo->findBySlug($slug);

        if(!empty($crop_estimate->file_location)){

            $path = $this->__static->archive_dir() .'/'. $crop_estimate->file_location;

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

        $crop_estimate = $this->crop_estimate_repo->findbySlug($slug);
        return view('dashboard.crop_estimate.edit')->with('crop_estimate', $crop_estimate);

    }







    public function update($request, $slug){

        $crop_estimate = $this->crop_estimate_repo->findbySlug($slug);
        
        $new_filename = $this->__dataType::fileFilterReservedChar($request->title .'-'. $this->str->random(8), '.pdf');
        $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/CROP-ESTIMATE';

        $old_file_location = $crop_estimate->file_location;
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
        }elseif($request->title != $crop_estimate->title && $this->storage->disk('local')->exists($old_file_location)){
            $this->storage->disk('local')->move($old_file_location, $new_file_location);
            $file_location = $new_file_location;
        }

        $crop_estimate = $this->crop_estimate_repo->update($request, $file_location, $crop_estimate);

        $this->event->fire('crop_estimate.update', $crop_estimate);
        return redirect()->route('dashboard.crop_estimate.index');

    }






    public function destroy($slug){

        $crop_estimate = $this->crop_estimate_repo->findbySlug($slug);

        if(!is_null($crop_estimate->file_location)){

            if ($this->storage->disk('local')->exists($crop_estimate->file_location)) {
                $this->storage->disk('local')->delete($crop_estimate->file_location);
            }

        }

        $crop_estimate = $this->crop_estimate_repo->destroy($crop_estimate);

        $this->event->fire('crop_estimate.destroy', $crop_estimate);
        return redirect()->back();

    }






}