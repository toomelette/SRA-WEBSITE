<?php
 
namespace App\Core\Services;

use File;
use App\Core\Interfaces\AdministratorInterface;
use App\Core\BaseClasses\BaseService;


class AdministratorService extends BaseService{


    protected $administrator_repo;



    public function __construct(AdministratorInterface $administrator_repo){

        $this->administrator_repo = $administrator_repo;
        parent::__construct();

    }





    public function fetch($request){

        $administrators = $this->administrator_repo->fetch($request);

        $request->flash();
        return view('dashboard.administrator.index')->with('administrators', $administrators);

    }






    public function store($request){

        $file_location = "";

        if(!is_null($request->file('doc_file'))){

            $filename = $this->__dataType::fileFilterReservedChar($request->fullname .'-'. $this->str->random(8), '.jpg');
            $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/ADMINISTRATORS';

            $request->file('doc_file')->storeAs($dir, $filename);

            $file_location = $dir .'/'. $filename;

        }
            

        $administrator = $this->administrator_repo->store($request, $file_location);
        
        $this->event->fire('administrator.store');
        return redirect()->back();
    }







    public function viewAvatar($slug){

        $administrator = $this->administrator_repo->findBySlug($slug);

        if(!empty($administrator->file_location)){

            $path = $this->__static->archive_dir() .'/'. $administrator->file_location;

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

        $administrator = $this->administrator_repo->findbySlug($slug);
        return view('dashboard.administrator.edit')->with('administrator', $administrator);

    }







    public function update($request, $slug){

        $administrator = $this->administrator_repo->findbySlug($slug);
        
        $new_filename = $this->__dataType::fileFilterReservedChar($request->fullname .'-'. $this->str->random(8), '.jpg');
        $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/ADMINISTRATORS';

        $old_file_location = $administrator->file_location;
        $new_file_location = $dir .'/'. $new_filename;

        $file_location = $old_file_location;

        // if doc_file has value
        if(!is_null($request->file('doc_file'))){

            if ($this->storage->disk('local')->exists($old_file_location)) {
                $this->storage->disk('local')->delete($old_file_location);
            }
            
            $request->file('doc_file')->storeAs($dir, $new_filename);
            $file_location = $new_file_location;

        // if fullname has change
        }elseif($request->fullname != $administrator->fullname && $this->storage->disk('local')->exists($old_file_location)){
            $this->storage->disk('local')->move($old_file_location, $new_file_location);
            $file_location = $new_file_location;
        }

        $administrator = $this->administrator_repo->update($request, $file_location, $administrator);

        $this->event->fire('administrator.update', $administrator);
        return redirect()->route('dashboard.administrator.index');

    }






    public function destroy($slug){

        $administrator = $this->administrator_repo->findbySlug($slug);

        if(!is_null($administrator->file_location)){

            if ($this->storage->disk('local')->exists($administrator->file_location)) {
                $this->storage->disk('local')->delete($administrator->file_location);
            }

        }

        $administrator = $this->administrator_repo->destroy($administrator);

        $this->event->fire('administrator.destroy', $administrator);
        return redirect()->back();

    }






}