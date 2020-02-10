<?php
 
namespace App\Core\Services;

use File;
use App\Core\Interfaces\ApplicationFormInterface;
use App\Core\BaseClasses\BaseService;


class ApplicationFormService extends BaseService{


    protected $application_form_repo;



    public function __construct(ApplicationFormInterface $application_form_repo){

        $this->application_form_repo = $application_form_repo;
        parent::__construct();

    }





    public function fetch($request){

        $application_forms = $this->application_form_repo->fetch($request);

        $request->flash();
        return view('dashboard.application_form.index')->with('application_forms', $application_forms);

    }






    public function store($request){

        $file_location = "";

        if(!is_null($request->file('doc_file'))){

            $filename = $this->__dataType::fileFilterReservedChar($request->title .'-'. $this->str->random(8), '.pdf');
            $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/APPLICATION-FORMS';

            $request->file('doc_file')->storeAs($dir, $filename);

            $file_location = $dir .'/'. $filename;

        }
            

        $application_form = $this->application_form_repo->store($request, $file_location);
        
        $this->event->fire('application_form.store');
        return redirect()->back();
    }







    public function viewFile($slug){

        $application_form = $this->application_form_repo->findBySlug($slug);

        if(!empty($application_form->file_location)){

            $path = $this->__static->archive_dir() .'/'. $application_form->file_location;

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

        $application_form = $this->application_form_repo->findbySlug($slug);
        return view('dashboard.application_form.edit')->with('application_form', $application_form);

    }







    public function update($request, $slug){

        $application_form = $this->application_form_repo->findbySlug($slug);
        
        $new_filename = $this->__dataType::fileFilterReservedChar($request->title .'-'. $this->str->random(8), '.pdf');
        $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/APPLICATION-FORMS';

        $old_file_location = $application_form->file_location;
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
        }elseif($request->title != $application_form->title && $this->storage->disk('local')->exists($old_file_location)){
            $this->storage->disk('local')->move($old_file_location, $new_file_location);
            $file_location = $new_file_location;
        }

        $application_form = $this->application_form_repo->update($request, $file_location, $application_form);

        $this->event->fire('application_form.update', $application_form);
        return redirect()->route('dashboard.application_form.index');

    }






    public function destroy($slug){

        $application_form = $this->application_form_repo->findbySlug($slug);

        if(!is_null($application_form->file_location)){

            if ($this->storage->disk('local')->exists($application_form->file_location)) {
                $this->storage->disk('local')->delete($application_form->file_location);
            }

        }

        $application_form = $this->application_form_repo->destroy($application_form);

        $this->event->fire('application_form.destroy', $application_form);
        return redirect()->back();

    }






}