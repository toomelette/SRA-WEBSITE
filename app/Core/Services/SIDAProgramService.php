<?php
 
namespace App\Core\Services;

use File;
use App\Core\Interfaces\SIDAProgramInterface;
use App\Core\BaseClasses\BaseService;


class SIDAProgramService extends BaseService{


    protected $sida_program_repo;



    public function __construct(SIDAProgramInterface $sida_program_repo){

        $this->sida_program_repo = $sida_program_repo;
        parent::__construct();

    }





    public function fetch($request){

        $sida_programs = $this->sida_program_repo->fetch($request);

        $request->flash();
        return view('dashboard.sida_program.index')->with('sida_programs', $sida_programs);

    }






    public function store($request){

        $file_location = "";

        if(!is_null($request->file('doc_file'))){

            $filename = $this->__dataType::fileFilterReservedChar($request->title .'-'. $this->str->random(8), '.pdf');
            $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/SIDA-PROGRAMS';

            $request->file('doc_file')->storeAs($dir, $filename);

            $file_location = $dir .'/'. $filename;

        }
            

        $sida_program = $this->sida_program_repo->store($request, $file_location);
        
        $this->event->fire('sida_program.store');
        return redirect()->back();
    }







    public function viewFile($slug){

        $sida_program = $this->sida_program_repo->findBySlug($slug);

        if(!empty($sida_program->file_location)){

            $path = $this->__static->archive_dir() .'/'. $sida_program->file_location;

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

        $sida_program = $this->sida_program_repo->findbySlug($slug);
        return view('dashboard.sida_program.edit')->with('sida_program', $sida_program);

    }







    public function update($request, $slug){

        $sida_program = $this->sida_program_repo->findbySlug($slug);
        
        $new_filename = $this->__dataType::fileFilterReservedChar($request->title .'-'. $this->str->random(8), '.pdf');
        $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/SIDA-PROGRAMS';

        $old_file_location = $sida_program->file_location;
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
        }elseif($request->title != $sida_program->title && $this->storage->disk('local')->exists($old_file_location)){
            $this->storage->disk('local')->move($old_file_location, $new_file_location);
            $file_location = $new_file_location;
        }

        $sida_program = $this->sida_program_repo->update($request, $file_location, $sida_program);

        $this->event->fire('sida_program.update', $sida_program);
        return redirect()->route('dashboard.sida_program.index');

    }






    public function destroy($slug){

        $sida_program = $this->sida_program_repo->findbySlug($slug);

        if(!is_null($sida_program->file_location)){

            if ($this->storage->disk('local')->exists($sida_program->file_location)) {
                $this->storage->disk('local')->delete($sida_program->file_location);
            }

        }

        $sida_program = $this->sida_program_repo->destroy($sida_program);

        $this->event->fire('sida_program.destroy', $sida_program);
        return redirect()->back();

    }






}