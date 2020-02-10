<?php
 
namespace App\Core\Services;

use File;
use App\Core\Interfaces\SMSFormInterface;
use App\Core\BaseClasses\BaseService;


class SMSFormService extends BaseService{


    protected $sms_form_repo;



    public function __construct(SMSFormInterface $sms_form_repo){

        $this->sms_form_repo = $sms_form_repo;
        parent::__construct();

    }





    public function fetch($request){

        $sms_forms = $this->sms_form_repo->fetch($request);

        $request->flash();
        return view('dashboard.sms_form.index')->with('sms_forms', $sms_forms);

    }






    public function store($request){

        $file_location = "";

        if(!is_null($request->file('doc_file'))){

            $filename = $this->__dataType::fileFilterReservedChar($request->title .'-'. $this->str->random(8), '.pdf');
            $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/SMS-DATA';

            $request->file('doc_file')->storeAs($dir, $filename);

            $file_location = $dir .'/'. $filename;

        }
            

        $sms_form = $this->sms_form_repo->store($request, $file_location);
        
        $this->event->fire('sms_form.store');
        return redirect()->back();
    }







    public function viewFile($slug){

        $sms_form = $this->sms_form_repo->findBySlug($slug);

        if(!empty($sms_form->file_location)){

            $path = $this->__static->archive_dir() .'/'. $sms_form->file_location;

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

        $sms_form = $this->sms_form_repo->findbySlug($slug);
        return view('dashboard.sms_form.edit')->with('sms_form', $sms_form);

    }







    public function update($request, $slug){

        $sms_form = $this->sms_form_repo->findbySlug($slug);
        
        $new_filename = $this->__dataType::fileFilterReservedChar($request->title .'-'. $this->str->random(8), '.pdf');
        $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/SMS-DATA';

        $old_file_location = $sms_form->file_location;
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
        }elseif($request->title != $sms_form->title && $this->storage->disk('local')->exists($old_file_location)){
            $this->storage->disk('local')->move($old_file_location, $new_file_location);
            $file_location = $new_file_location;
        }

        $sms_form = $this->sms_form_repo->update($request, $file_location, $sms_form);

        $this->event->fire('sms_form.update', $sms_form);
        return redirect()->route('dashboard.sms_form.index');

    }






    public function destroy($slug){

        $sms_form = $this->sms_form_repo->findbySlug($slug);

        if(!is_null($sms_form->file_location)){

            if ($this->storage->disk('local')->exists($sms_form->file_location)) {
                $this->storage->disk('local')->delete($sms_form->file_location);
            }

        }

        $sms_form = $this->sms_form_repo->destroy($sms_form);

        $this->event->fire('sms_form.destroy', $sms_form);
        return redirect()->back();

    }






}