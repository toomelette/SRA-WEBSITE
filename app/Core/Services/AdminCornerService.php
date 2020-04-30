<?php
 
namespace App\Core\Services;

use File;
use App\Core\Interfaces\AdminCornerInterface;
use App\Core\BaseClasses\BaseService;


class AdminCornerService extends BaseService{


    protected $admin_corner_repo;



    public function __construct(AdminCornerInterface $admin_corner_repo){

        $this->admin_corner_repo = $admin_corner_repo;
        parent::__construct();

    }





    public function fetch($request){

        $admin_corners = $this->admin_corner_repo->fetch($request);

        $request->flash();
        return view('dashboard.admin_corner.index')->with('admin_corners', $admin_corners);

    }






    public function store($request){

        $img_location = "";

        if(!is_null($request->file('img_file'))){
            $filename = $this->__dataType::fileFilterReservedChar($request->title .'-'. $this->str->random(8), '.jpg');
            $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/ADMIN-CORNER';
            $request->file('img_file')->storeAs($dir, $filename);
            $img_location = $dir .'/'. $filename;
        }

        $admin_corner = $this->admin_corner_repo->store($request, $img_location);
        
        $this->event->fire('admin_corner.store');
        return redirect()->back();
    }







    public function viewImg($slug){

        $admin_corner = $this->admin_corner_repo->findBySlug($slug);

        if(!empty($admin_corner->img_location)){

            $path = $this->__static->archive_dir() .'/'. $admin_corner->img_location;

            if (!File::exists($path)) { return "Cannot Detect File!"; }

            $file = File::get($path);
            $type = File::mimeType($path);

            $response = response()->make($file, 200);
            $response->header("Content-Type", $type);

            return $response;

        }

        return "Cannot Detect File!";
        

    }






    public function edit($slug){

        $admin_corner = $this->admin_corner_repo->findbySlug($slug);
        return view('dashboard.admin_corner.edit')->with('admin_corner', $admin_corner);

    }







    public function update($request, $slug){

        $admin_corner = $this->admin_corner_repo->findbySlug($slug);
        
        $new_filename = $this->__dataType::fileFilterReservedChar($request->title .'-'. $this->str->random(8), '.jpg');
        $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/ADMIN-CORNER';

        $old_img_location = $admin_corner->img_location;
        $new_img_location = $dir .'/'. $new_filename;

        $img_location = $old_img_location;

        // if img_file has value
        if(!is_null($request->file('img_file'))){

            if ($this->storage->disk('local')->exists($old_img_location)) {
                $this->storage->disk('local')->delete($old_img_location);
            }
            
            $request->file('img_file')->storeAs($dir, $new_filename);
            $img_location = $new_img_location;

        // if title has change
        }elseif($request->title != $admin_corner->title && $this->storage->disk('local')->exists($old_img_location)){
            $this->storage->disk('local')->move($old_img_location, $new_img_location);
            $img_location = $new_img_location;
        }

        $admin_corner = $this->admin_corner_repo->update($request, $img_location, $admin_corner);

        $this->event->fire('admin_corner.update', $admin_corner);
        return redirect()->route('dashboard.admin_corner.index');

    }






    public function destroy($slug){

        $admin_corner = $this->admin_corner_repo->findbySlug($slug);

        if(!is_null($admin_corner->img_location)){

            if ($this->storage->disk('local')->exists($admin_corner->img_location)) {
                $this->storage->disk('local')->delete($admin_corner->img_location);
            }

        }

        $admin_corner = $this->admin_corner_repo->destroy($admin_corner);

        $this->event->fire('admin_corner.destroy', $admin_corner);
        return redirect()->back();

    }






}