<?php
 
namespace App\Core\Services;

use File;
use App\Core\Interfaces\HistoricalDataInterface;
use App\Core\BaseClasses\BaseService;


class HistoricalDataService extends BaseService{


    protected $historical_data_repo;



    public function __construct(HistoricalDataInterface $historical_data_repo){

        $this->historical_data_repo = $historical_data_repo;
        parent::__construct();

    }





    public function fetch($request){

        $historical_datas = $this->historical_data_repo->fetch($request);

        $request->flash();
        return view('dashboard.historical_data.index')->with('historical_datas', $historical_datas);

    }






    public function store($request){

        $file_location = "";

        if(!is_null($request->file('doc_file'))){

            $filename = $this->__dataType::fileFilterReservedChar($request->title .'-'. $this->str->random(8), '.pdf');
            $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/HISTORICAL-DATA';

            $request->file('doc_file')->storeAs($dir, $filename);

            $file_location = $dir .'/'. $filename;

        }
            

        $historical_data = $this->historical_data_repo->store($request, $file_location);
        
        $this->event->fire('historical_data.store');
        return redirect()->back();
    }







    public function viewFile($slug){

        $historical_data = $this->historical_data_repo->findBySlug($slug);

        if(!empty($historical_data->file_location)){

            $path = $this->__static->archive_dir() .'/'. $historical_data->file_location;

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

        $historical_data = $this->historical_data_repo->findbySlug($slug);
        return view('dashboard.historical_data.edit')->with('historical_data', $historical_data);

    }







    public function update($request, $slug){

        $historical_data = $this->historical_data_repo->findbySlug($slug);
        
        $new_filename = $this->__dataType::fileFilterReservedChar($request->title .'-'. $this->str->random(8), '.pdf');
        $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/HISTORICAL-DATA';

        $old_file_location = $historical_data->file_location;
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
        }elseif($request->title != $historical_data->title && $this->storage->disk('local')->exists($old_file_location)){
            $this->storage->disk('local')->move($old_file_location, $new_file_location);
            $file_location = $new_file_location;
        }

        $historical_data = $this->historical_data_repo->update($request, $file_location, $historical_data);

        $this->event->fire('historical_data.update', $historical_data);
        return redirect()->route('dashboard.historical_data.index');

    }






    public function destroy($slug){

        $historical_data = $this->historical_data_repo->findbySlug($slug);

        if(!is_null($historical_data->file_location)){

            if ($this->storage->disk('local')->exists($historical_data->file_location)) {
                $this->storage->disk('local')->delete($historical_data->file_location);
            }

        }

        $historical_data = $this->historical_data_repo->destroy($historical_data);

        $this->event->fire('historical_data.destroy', $historical_data);
        return redirect()->back();

    }






}