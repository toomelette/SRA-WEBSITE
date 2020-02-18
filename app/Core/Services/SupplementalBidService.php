<?php
 
namespace App\Core\Services;

use File;
use App\Core\Interfaces\SupplementalBidInterface;
use App\Core\BaseClasses\BaseService;


class SupplementalBidService extends BaseService{


    protected $supplemental_bid_repo;



    public function __construct(SupplementalBidInterface $supplemental_bid_repo){

        $this->supplemental_bid_repo = $supplemental_bid_repo;
        parent::__construct();

    }





    public function fetch($request){

        $supplemental_bids = $this->supplemental_bid_repo->fetch($request);

        $request->flash();
        return view('dashboard.supplemental_bid.index')->with('supplemental_bids', $supplemental_bids);

    }






    public function store($request){

        $file_location = "";

        if(!is_null($request->file('doc_file'))){

            $filename = $this->__dataType::fileFilterReservedChar($request->description .'-'. $this->str->random(8), '.pdf');
            $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/SUPPLEMENTAL-BIDS';

            $request->file('doc_file')->storeAs($dir, $filename);

            $file_location = $dir .'/'. $filename;

        }
            

        $supplemental_bid = $this->supplemental_bid_repo->store($request, $file_location);
        
        $this->event->fire('supplemental_bid.store');
        return redirect()->back();
    }







    public function viewFile($slug){

        $supplemental_bid = $this->supplemental_bid_repo->findBySlug($slug);

        if(!empty($supplemental_bid->file_location)){

            $path = $this->__static->archive_dir() .'/'. $supplemental_bid->file_location;

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

        $supplemental_bid = $this->supplemental_bid_repo->findbySlug($slug);
        return view('dashboard.supplemental_bid.edit')->with('supplemental_bid', $supplemental_bid);

    }







    public function update($request, $slug){

        $supplemental_bid = $this->supplemental_bid_repo->findbySlug($slug);
        
        $new_filename = $this->__dataType::fileFilterReservedChar($request->description .'-'. $this->str->random(8), '.pdf');
        $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/SUPPLEMENTAL-BIDS';

        $old_file_location = $supplemental_bid->file_location;
        $new_file_location = $dir .'/'. $new_filename;

        $file_location = $old_file_location;

        // if doc_file has value
        if(!is_null($request->file('doc_file'))){

            if ($this->storage->disk('local')->exists($old_file_location)) {
                $this->storage->disk('local')->delete($old_file_location);
            }
            
            $request->file('doc_file')->storeAs($dir, $new_filename);
            $file_location = $new_file_location;

        // if description has change
        }elseif($request->description != $supplemental_bid->description && $this->storage->disk('local')->exists($old_file_location)){
            $this->storage->disk('local')->move($old_file_location, $new_file_location);
            $file_location = $new_file_location;
        }

        $supplemental_bid = $this->supplemental_bid_repo->update($request, $file_location, $supplemental_bid);

        $this->event->fire('supplemental_bid.update', $supplemental_bid);
        return redirect()->route('dashboard.supplemental_bid.index');

    }






    public function destroy($slug){

        $supplemental_bid = $this->supplemental_bid_repo->findbySlug($slug);

        if(!is_null($supplemental_bid->file_location)){

            if ($this->storage->disk('local')->exists($supplemental_bid->file_location)) {
                $this->storage->disk('local')->delete($supplemental_bid->file_location);
            }

        }

        $supplemental_bid = $this->supplemental_bid_repo->destroy($supplemental_bid);

        $this->event->fire('supplemental_bid.destroy', $supplemental_bid);
        return redirect()->back();

    }






}