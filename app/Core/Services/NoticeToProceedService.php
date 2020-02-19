<?php
 
namespace App\Core\Services;

use File;
use App\Core\Interfaces\NoticeToProceedInterface;
use App\Core\BaseClasses\BaseService;


class NoticeToProceedService extends BaseService{


    protected $notice_to_proceed_repo;



    public function __construct(NoticeToProceedInterface $notice_to_proceed_repo){

        $this->notice_to_proceed_repo = $notice_to_proceed_repo;
        parent::__construct();

    }





    public function fetch($request){

        $notice_to_proceed = $this->notice_to_proceed_repo->fetch($request);

        $request->flash();
        return view('dashboard.notice_to_proceed.index')->with('notice_to_proceed', $notice_to_proceed);

    }






    public function store($request){

        $file_location_ntp = "";
        $file_location_po = "";

        if(!is_null($request->file('doc_file_ntp'))){

            $file_location_ntp = $this->__dataType::fileFilterReservedChar($request->description .'-'. $this->str->random(8), '.pdf');
            $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/NOTICE-TO-PROCEED/NTP';
            $request->file('doc_file_ntp')->storeAs($dir, $file_location_ntp);
            $file_location_ntp = $dir .'/'. $file_location_ntp;

        }

        if(!is_null($request->file('doc_file_po'))){

            $file_location_po = $this->__dataType::fileFilterReservedChar($request->description .'-'. $this->str->random(8), '.pdf');
            $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/NOTICE-TO-PROCEED/PO';
            $request->file('doc_file_po')->storeAs($dir, $file_location_po);
            $file_location_po = $dir .'/'. $file_location_po;

        }

        $notice_to_proceed = $this->notice_to_proceed_repo->store($request, $file_location_ntp, $file_location_po);
        
        $this->event->fire('notice_to_proceed.store');
        return redirect()->back();
    }







    public function viewFile($slug, $type){

        $notice_to_proceed = $this->notice_to_proceed_repo->findBySlug($slug);

        if($type == 'NTP' && !empty($notice_to_proceed->file_location_ntp)){

            $path = $this->__static->archive_dir() .'/'. $notice_to_proceed->file_location_ntp;

            if (!File::exists($path)) { return "Cannot Detect File!"; }

            $file = File::get($path);
            $type = File::mimeType($path);

            $response = response()->make($file, 200);
            $response->header("Content-Type", $type);

            return $response;

        }

        if($type == 'PO' && !empty($notice_to_proceed->file_location_po)){

            $path = $this->__static->archive_dir() .'/'. $notice_to_proceed->file_location_po;

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

        $notice_to_proceed = $this->notice_to_proceed_repo->findbySlug($slug);
        return view('dashboard.notice_to_proceed.edit')->with('notice_to_proceed', $notice_to_proceed);

    }







    public function update($request, $slug){

        $notice_to_proceed = $this->notice_to_proceed_repo->findbySlug($slug);
        
        $new_filename_ntp = $this->__dataType::fileFilterReservedChar($request->description .'-'. $this->str->random(8), '.pdf');
        $new_filename_po = $this->__dataType::fileFilterReservedChar($request->description .'-'. $this->str->random(8), '.pdf');
        
        $dir_ntp = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/NOTICE-TO-PROCEED/NTP';
        $dir_po = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/NOTICE-TO-PROCEED/PO';

        $old_file_location_ntp = $notice_to_proceed->file_location_ntp;
        $old_file_location_po = $notice_to_proceed->file_location_po;
        
        $new_file_location_ntp = $dir_ntp .'/'. $new_filename_ntp;
        $new_file_location_po = $dir_po .'/'. $new_filename_po;

        $file_location_ntp = $old_file_location_ntp;
        $file_location_po = $old_file_location_po;



        // if doc_file_ntp has value
        if(!is_null($request->file('doc_file_ntp'))){

            if ($this->storage->disk('local')->exists($old_file_location_ntp)) {
                $this->storage->disk('local')->delete($old_file_location_ntp);
            }
            
            $request->file('doc_file_ntp')->storeAs($dir_ntp, $new_filename_ntp);
            $file_location_ntp = $new_file_location_ntp;

        // if description has change
        }elseif($request->description != $notice_to_proceed->description && $this->storage->disk('local')->exists($old_file_location_ntp)){
            $this->storage->disk('local')->move($old_file_location_ntp, $new_file_location_ntp);
            $file_location_ntp = $new_file_location_ntp;
        }



        // if doc_file_po has value
        if(!is_null($request->file('doc_file_po'))){

            if ($this->storage->disk('local')->exists($old_file_location_po)) {
                $this->storage->disk('local')->delete($old_file_location_po);
            }
            
            $request->file('doc_file_po')->storeAs($dir_po, $new_filename_po);
            $file_location_po = $new_file_location_po;

        // if description has change
        }elseif($request->description != $notice_to_proceed->description && $this->storage->disk('local')->exists($old_file_location_po)){
            $this->storage->disk('local')->move($old_file_location_po, $new_file_location_po);
            $file_location_po = $new_file_location_po;
        }



        $notice_to_proceed = $this->notice_to_proceed_repo->update($request, $file_location_ntp, $file_location_po, $notice_to_proceed);

        $this->event->fire('notice_to_proceed.update', $notice_to_proceed);
        return redirect()->route('dashboard.notice_to_proceed.index');

    }






    public function destroy($slug){

        $notice_to_proceed = $this->notice_to_proceed_repo->findbySlug($slug);

        if(!is_null($notice_to_proceed->file_location_ntp)){

            if ($this->storage->disk('local')->exists($notice_to_proceed->file_location_ntp)) {
                $this->storage->disk('local')->delete($notice_to_proceed->file_location_ntp);
            }

        }

        if(!is_null($notice_to_proceed->file_location_po)){

            if ($this->storage->disk('local')->exists($notice_to_proceed->file_location_po)) {
                $this->storage->disk('local')->delete($notice_to_proceed->file_location_po);
            }

        }

        $notice_to_proceed = $this->notice_to_proceed_repo->destroy($notice_to_proceed);

        $this->event->fire('notice_to_proceed.destroy', $notice_to_proceed);
        return redirect()->back();

    }






}