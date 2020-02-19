<?php
 
namespace App\Core\Services;

use File;
use App\Core\Interfaces\MinutesOfTheBidInterface;
use App\Core\BaseClasses\BaseService;


class MinutesOfTheBidService extends BaseService{


    protected $minutes_of_the_bid_repo;



    public function __construct(MinutesOfTheBidInterface $minutes_of_the_bid_repo){

        $this->minutes_of_the_bid_repo = $minutes_of_the_bid_repo;
        parent::__construct();

    }





    public function fetch($request){

        $minutes_of_the_bid = $this->minutes_of_the_bid_repo->fetch($request);

        $request->flash();
        return view('dashboard.minutes_of_the_bid.index')->with('minutes_of_the_bid', $minutes_of_the_bid);

    }






    public function store($request){

        $file_location = "";

        if(!is_null($request->file('doc_file'))){

            $filename = $this->__dataType::fileFilterReservedChar($request->title .'-'. $this->str->random(8), '.pdf');
            $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/MINUTES-OF-THE-BID';

            $request->file('doc_file')->storeAs($dir, $filename);

            $file_location = $dir .'/'. $filename;

        }
            

        $minutes_of_the_bid = $this->minutes_of_the_bid_repo->store($request, $file_location);
        
        $this->event->fire('minutes_of_the_bid.store');
        return redirect()->back();
    }







    public function viewFile($slug){

        $minutes_of_the_bid = $this->minutes_of_the_bid_repo->findBySlug($slug);

        if(!empty($minutes_of_the_bid->file_location)){

            $path = $this->__static->archive_dir() .'/'. $minutes_of_the_bid->file_location;

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

        $minutes_of_the_bid = $this->minutes_of_the_bid_repo->findbySlug($slug);
        return view('dashboard.minutes_of_the_bid.edit')->with('minutes_of_the_bid', $minutes_of_the_bid);

    }







    public function update($request, $slug){

        $minutes_of_the_bid = $this->minutes_of_the_bid_repo->findbySlug($slug);
        
        $new_filename = $this->__dataType::fileFilterReservedChar($request->title .'-'. $this->str->random(8), '.pdf');
        $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/MINUTES-OF-THE-BID';

        $old_file_location = $minutes_of_the_bid->file_location;
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
        }elseif($request->title != $minutes_of_the_bid->title && $this->storage->disk('local')->exists($old_file_location)){
            $this->storage->disk('local')->move($old_file_location, $new_file_location);
            $file_location = $new_file_location;
        }

        $minutes_of_the_bid = $this->minutes_of_the_bid_repo->update($request, $file_location, $minutes_of_the_bid);

        $this->event->fire('minutes_of_the_bid.update', $minutes_of_the_bid);
        return redirect()->route('dashboard.minutes_of_the_bid.index');

    }






    public function destroy($slug){

        $minutes_of_the_bid = $this->minutes_of_the_bid_repo->findbySlug($slug);

        if(!is_null($minutes_of_the_bid->file_location)){

            if ($this->storage->disk('local')->exists($minutes_of_the_bid->file_location)) {
                $this->storage->disk('local')->delete($minutes_of_the_bid->file_location);
            }

        }

        $minutes_of_the_bid = $this->minutes_of_the_bid_repo->destroy($minutes_of_the_bid);

        $this->event->fire('minutes_of_the_bid.destroy', $minutes_of_the_bid);
        return redirect()->back();

    }






}