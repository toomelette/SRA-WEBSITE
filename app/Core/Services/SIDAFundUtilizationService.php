<?php
 
namespace App\Core\Services;

use File;
use App\Core\Interfaces\SIDAFundUtilizationInterface;
use App\Core\BaseClasses\BaseService;


class SIDAFundUtilizationService extends BaseService{


    protected $sida_fund_utilization_repo;



    public function __construct(SIDAFundUtilizationInterface $sida_fund_utilization_repo){

        $this->sida_fund_utilization_repo = $sida_fund_utilization_repo;
        parent::__construct();

    }





    public function fetch($request){

        $sida_fund_utilizations = $this->sida_fund_utilization_repo->fetch($request);

        $request->flash();
        return view('dashboard.sida_fund_utilization.index')->with('sida_fund_utilizations', $sida_fund_utilizations);

    }






    public function store($request){

        $file_location = "";

        if(!is_null($request->file('doc_file'))){

            $filename = $this->__dataType::fileFilterReservedChar($request->title .'-'. $this->str->random(8), '.pdf');
            $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/SIDA-FUND-UTILIZATION';

            $request->file('doc_file')->storeAs($dir, $filename);

            $file_location = $dir .'/'. $filename;

        }
            

        $sida_fund_utilization = $this->sida_fund_utilization_repo->store($request, $file_location);
        
        $this->event->fire('sida_fund_utilization.store');
        return redirect()->back();
    }







    public function viewFile($slug){

        $sida_fund_utilization = $this->sida_fund_utilization_repo->findBySlug($slug);

        if(!empty($sida_fund_utilization->file_location)){

            $path = $this->__static->archive_dir() .'/'. $sida_fund_utilization->file_location;

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

        $sida_fund_utilization = $this->sida_fund_utilization_repo->findbySlug($slug);
        return view('dashboard.sida_fund_utilization.edit')->with('sida_fund_utilization', $sida_fund_utilization);

    }







    public function update($request, $slug){

        $sida_fund_utilization = $this->sida_fund_utilization_repo->findbySlug($slug);
        
        $new_filename = $this->__dataType::fileFilterReservedChar($request->title .'-'. $this->str->random(8), '.pdf');
        $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/SIDA-FUND-UTILIZATION';

        $old_file_location = $sida_fund_utilization->file_location;
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
        }elseif($request->title != $sida_fund_utilization->title && $this->storage->disk('local')->exists($old_file_location)){
            $this->storage->disk('local')->move($old_file_location, $new_file_location);
            $file_location = $new_file_location;
        }

        $sida_fund_utilization = $this->sida_fund_utilization_repo->update($request, $file_location, $sida_fund_utilization);

        $this->event->fire('sida_fund_utilization.update', $sida_fund_utilization);
        return redirect()->route('dashboard.sida_fund_utilization.index');

    }






    public function destroy($slug){

        $sida_fund_utilization = $this->sida_fund_utilization_repo->findbySlug($slug);

        if(!is_null($sida_fund_utilization->file_location)){

            if ($this->storage->disk('local')->exists($sida_fund_utilization->file_location)) {
                $this->storage->disk('local')->delete($sida_fund_utilization->file_location);
            }

        }

        $sida_fund_utilization = $this->sida_fund_utilization_repo->destroy($sida_fund_utilization);

        $this->event->fire('sida_fund_utilization.destroy', $sida_fund_utilization);
        return redirect()->back();

    }






}