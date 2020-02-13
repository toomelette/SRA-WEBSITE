<?php
 
namespace App\Core\Services;

use File;
use App\Core\Interfaces\IndustryStatisticInterface;
use App\Core\BaseClasses\BaseService;


class IndustryStatisticService extends BaseService{


    protected $industry_statistic_repo;



    public function __construct(IndustryStatisticInterface $industry_statistic_repo){

        $this->industry_statistic_repo = $industry_statistic_repo;
        parent::__construct();

    }





    public function fetch($request){

        $industry_statistics = $this->industry_statistic_repo->fetch($request);

        $request->flash();
        return view('dashboard.industry_statistic.index')->with('industry_statistics', $industry_statistics);

    }






    public function store($request){

        $file_location = "";

        if(!is_null($request->file('doc_file'))){

            $filename = $this->__dataType::fileFilterReservedChar($request->title .'-'. $this->str->random(8), '.pdf');
            $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/INDUSTRY-STATISTIC';

            $request->file('doc_file')->storeAs($dir, $filename);

            $file_location = $dir .'/'. $filename;

        }
            

        $industry_statistic = $this->industry_statistic_repo->store($request, $file_location);
        
        $this->event->fire('industry_statistic.store');
        return redirect()->back();
    }







    public function viewFile($slug){

        $industry_statistic = $this->industry_statistic_repo->findBySlug($slug);

        if(!empty($industry_statistic->file_location)){

            $path = $this->__static->archive_dir() .'/'. $industry_statistic->file_location;

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

        $industry_statistic = $this->industry_statistic_repo->findbySlug($slug);
        return view('dashboard.industry_statistic.edit')->with('industry_statistic', $industry_statistic);

    }







    public function update($request, $slug){

        $industry_statistic = $this->industry_statistic_repo->findbySlug($slug);
        
        $new_filename = $this->__dataType::fileFilterReservedChar($request->title .'-'. $this->str->random(8), '.pdf');
        $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/INDUSTRY-STATISTIC';

        $old_file_location = $industry_statistic->file_location;
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
        }elseif($request->title != $industry_statistic->title && $this->storage->disk('local')->exists($old_file_location)){
            $this->storage->disk('local')->move($old_file_location, $new_file_location);
            $file_location = $new_file_location;
        }

        $industry_statistic = $this->industry_statistic_repo->update($request, $file_location, $industry_statistic);

        $this->event->fire('industry_statistic.update', $industry_statistic);
        return redirect()->route('dashboard.industry_statistic.index');

    }






    public function destroy($slug){

        $industry_statistic = $this->industry_statistic_repo->findbySlug($slug);

        if(!is_null($industry_statistic->file_location)){

            if ($this->storage->disk('local')->exists($industry_statistic->file_location)) {
                $this->storage->disk('local')->delete($industry_statistic->file_location);
            }

        }

        $industry_statistic = $this->industry_statistic_repo->destroy($industry_statistic);

        $this->event->fire('industry_statistic.destroy', $industry_statistic);
        return redirect()->back();

    }






}