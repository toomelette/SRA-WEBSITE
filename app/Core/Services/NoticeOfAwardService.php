<?php
 
namespace App\Core\Services;

use File;
use App\Core\Interfaces\NoticeOfAwardInterface;
use App\Core\BaseClasses\BaseService;


class NoticeOfAwardService extends BaseService{


    protected $notice_of_award_repo;



    public function __construct(NoticeOfAwardInterface $notice_of_award_repo){

        $this->notice_of_award_repo = $notice_of_award_repo;
        parent::__construct();

    }





    public function fetch($request){

        $notice_of_award = $this->notice_of_award_repo->fetch($request);

        $request->flash();
        return view('dashboard.notice_of_award.index')->with('notice_of_award', $notice_of_award);

    }






    public function store($request){

        $file_location_noa = "";
        $file_location_bacreso = "";

        if(!is_null($request->file('doc_file_noa'))){

            $file_location_noa = $this->__dataType::fileFilterReservedChar($request->description .'-'. $this->str->random(8), '.pdf');
            $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/NOTICE-OF-AWARD/NOA';
            $request->file('doc_file_noa')->storeAs($dir, $file_location_noa);
            $file_location_noa = $dir .'/'. $file_location_noa;

        }

        if(!is_null($request->file('doc_file_bacreso'))){

            $file_location_bacreso = $this->__dataType::fileFilterReservedChar($request->description .'-'. $this->str->random(8), '.pdf');
            $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/NOTICE-OF-AWARD/BACRESO';
            $request->file('doc_file_bacreso')->storeAs($dir, $file_location_bacreso);
            $file_location_bacreso = $dir .'/'. $file_location_bacreso;

        }

        $notice_of_award = $this->notice_of_award_repo->store($request, $file_location_noa, $file_location_bacreso);
        
        $this->event->fire('notice_of_award.store');
        return redirect()->back();
    }







    public function viewFile($slug, $type){

        $notice_of_award = $this->notice_of_award_repo->findBySlug($slug);

        if($type == 'NOA' && !empty($notice_of_award->file_location_noa)){

            $path = $this->__static->archive_dir() .'/'. $notice_of_award->file_location_noa;

            if (!File::exists($path)) { return "Cannot Detect File!"; }

            $file = File::get($path);
            $type = File::mimeType($path);

            $response = response()->make($file, 200);
            $response->header("Content-Type", $type);

            return $response;

        }

        if($type == 'BACRESO' && !empty($notice_of_award->file_location_bacreso)){

            $path = $this->__static->archive_dir() .'/'. $notice_of_award->file_location_bacreso;

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

        $notice_of_award = $this->notice_of_award_repo->findbySlug($slug);
        return view('dashboard.notice_of_award.edit')->with('notice_of_award', $notice_of_award);

    }







    public function update($request, $slug){

        $notice_of_award = $this->notice_of_award_repo->findbySlug($slug);
        
        $new_filename_noa = $this->__dataType::fileFilterReservedChar($request->description .'-'. $this->str->random(8), '.pdf');
        $new_filename_bacreso = $this->__dataType::fileFilterReservedChar($request->description .'-'. $this->str->random(8), '.pdf');
        
        $dir_noa = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/NOTICE-OF-AWARD/NOA';
        $dir_bacreso = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/NOTICE-OF-AWARD/BACRESO';

        $old_file_location_noa = $notice_of_award->file_location_noa;
        $old_file_location_bacreso = $notice_of_award->file_location_bacreso;
        
        $new_file_location_noa = $dir_noa .'/'. $new_filename_noa;
        $new_file_location_bacreso = $dir_bacreso .'/'. $new_filename_bacreso;

        $file_location_noa = $old_file_location_noa;
        $file_location_bacreso = $old_file_location_bacreso;



        // if doc_file_noa has value
        if(!is_null($request->file('doc_file_noa'))){

            if ($this->storage->disk('local')->exists($old_file_location_noa)) {
                $this->storage->disk('local')->delete($old_file_location_noa);
            }
            
            $request->file('doc_file_noa')->storeAs($dir_noa, $new_filename_noa);
            $file_location_noa = $new_file_location_noa;

        // if description has change
        }elseif($request->description != $notice_of_award->description && $this->storage->disk('local')->exists($old_file_location_noa)){
            $this->storage->disk('local')->move($old_file_location_noa, $new_file_location_noa);
            $file_location_noa = $new_file_location_noa;
        }



        // if doc_file_bacreso has value
        if(!is_null($request->file('doc_file_bacreso'))){

            if ($this->storage->disk('local')->exists($old_file_location_bacreso)) {
                $this->storage->disk('local')->delete($old_file_location_bacreso);
            }
            
            $request->file('doc_file_bacreso')->storeAs($dir_bacreso, $new_filename_bacreso);
            $file_location_bacreso = $new_file_location_bacreso;

        // if description has change
        }elseif($request->description != $notice_of_award->description && $this->storage->disk('local')->exists($old_file_location_bacreso)){
            $this->storage->disk('local')->move($old_file_location_bacreso, $new_file_location_bacreso);
            $file_location_bacreso = $new_file_location_bacreso;
        }



        $notice_of_award = $this->notice_of_award_repo->update($request, $file_location_noa, $file_location_bacreso, $notice_of_award);

        $this->event->fire('notice_of_award.update', $notice_of_award);
        return redirect()->route('dashboard.notice_of_award.index');

    }






    public function destroy($slug){

        $notice_of_award = $this->notice_of_award_repo->findbySlug($slug);

        if(!is_null($notice_of_award->file_location_noa)){

            if ($this->storage->disk('local')->exists($notice_of_award->file_location_noa)) {
                $this->storage->disk('local')->delete($notice_of_award->file_location_noa);
            }

        }

        if(!is_null($notice_of_award->file_location_bacreso)){

            if ($this->storage->disk('local')->exists($notice_of_award->file_location_bacreso)) {
                $this->storage->disk('local')->delete($notice_of_award->file_location_bacreso);
            }

        }

        $notice_of_award = $this->notice_of_award_repo->destroy($notice_of_award);

        $this->event->fire('notice_of_award.destroy', $notice_of_award);
        return redirect()->back();

    }






}