<?php
 
namespace App\Core\Services;

use File;
use App\Core\Interfaces\BlockFarmInterface;
use App\Core\BaseClasses\BaseService;


class BlockFarmService extends BaseService{


    protected $block_farm_repo;



    public function __construct(BlockFarmInterface $block_farm_repo){

        $this->block_farm_repo = $block_farm_repo;
        parent::__construct();

    }





    public function fetch($request){

        $block_farms = $this->block_farm_repo->fetch($request);

        $request->flash();
        return view('dashboard.block_farm.index')->with('block_farms', $block_farms);

    }






    public function store($request){

        $file_location = "";

        if(!is_null($request->file('doc_file'))){

            $filename = $this->__dataType::fileFilterReservedChar($request->title .'-'. $this->str->random(8), '.pdf');
            $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/BLOCK-FARM';

            $request->file('doc_file')->storeAs($dir, $filename);

            $file_location = $dir .'/'. $filename;

        }
            

        $block_farm = $this->block_farm_repo->store($request, $file_location);
        
        $this->event->fire('block_farm.store');
        return redirect()->back();
    }







    public function viewFile($slug){

        $block_farm = $this->block_farm_repo->findBySlug($slug);

        if(!empty($block_farm->file_location)){

            $path = $this->__static->archive_dir() .'/'. $block_farm->file_location;

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

        $block_farm = $this->block_farm_repo->findbySlug($slug);
        return view('dashboard.block_farm.edit')->with('block_farm', $block_farm);

    }







    public function update($request, $slug){

        $block_farm = $this->block_farm_repo->findbySlug($slug);
        
        $new_filename = $this->__dataType::fileFilterReservedChar($request->title .'-'. $this->str->random(8), '.pdf');
        $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/BLOCK-FARM';

        $old_file_location = $block_farm->file_location;
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
        }elseif($request->title != $block_farm->title && $this->storage->disk('local')->exists($old_file_location)){
            $this->storage->disk('local')->move($old_file_location, $new_file_location);
            $file_location = $new_file_location;
        }

        $block_farm = $this->block_farm_repo->update($request, $file_location, $block_farm);

        $this->event->fire('block_farm.update', $block_farm);
        return redirect()->route('dashboard.block_farm.index');

    }






    public function destroy($slug){

        $block_farm = $this->block_farm_repo->findbySlug($slug);

        if(!is_null($block_farm->file_location)){

            if ($this->storage->disk('local')->exists($block_farm->file_location)) {
                $this->storage->disk('local')->delete($block_farm->file_location);
            }

        }

        $block_farm = $this->block_farm_repo->destroy($block_farm);

        $this->event->fire('block_farm.destroy', $block_farm);
        return redirect()->back();

    }






}