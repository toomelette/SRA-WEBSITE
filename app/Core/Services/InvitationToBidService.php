<?php
 
namespace App\Core\Services;

use File;
use App\Core\Interfaces\InvitationToBidInterface;
use App\Core\BaseClasses\BaseService;


class InvitationToBidService extends BaseService{


    protected $invitation_to_bid_repo;



    public function __construct(InvitationToBidInterface $invitation_to_bid_repo){

        $this->invitation_to_bid_repo = $invitation_to_bid_repo;
        parent::__construct();

    }





    public function fetch($request){

        $invitations_to_bid = $this->invitation_to_bid_repo->fetch($request);

        $request->flash();
        return view('dashboard.invitation_to_bid.index')->with('invitations_to_bid', $invitations_to_bid);

    }






    public function store($request){

        $file_location_itb = "";
        $file_location_pbd = "";

        if(!is_null($request->file('doc_file_itb'))){

            $file_location_itb = $this->__dataType::fileFilterReservedChar($request->description .'-'. $this->str->random(8), '.pdf');
            $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/INVITATION-TO-BID/ITB';
            $request->file('doc_file_itb')->storeAs($dir, $file_location_itb);
            $file_location_itb = $dir .'/'. $file_location_itb;

        }

        if(!is_null($request->file('doc_file_pbd'))){

            $file_location_pbd = $this->__dataType::fileFilterReservedChar($request->description .'-'. $this->str->random(8), '.pdf');
            $dir = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/INVITATION-TO-BID/PBD';
            $request->file('doc_file_pbd')->storeAs($dir, $file_location_pbd);
            $file_location_pbd = $dir .'/'. $file_location_pbd;

        }

        $invitation_to_bid = $this->invitation_to_bid_repo->store($request, $file_location_itb, $file_location_pbd);
        
        $this->event->fire('invitation_to_bid.store');
        return redirect()->back();
    }







    public function viewFile($slug, $type){

        $invitation_to_bid = $this->invitation_to_bid_repo->findBySlug($slug);

        if($type == 'ITB' && !empty($invitation_to_bid->file_location_itb)){

            $path = $this->__static->archive_dir() .'/'. $invitation_to_bid->file_location_itb;

            if (!File::exists($path)) { return "Cannot Detect File!"; }

            $file = File::get($path);
            $type = File::mimeType($path);

            $response = response()->make($file, 200);
            $response->header("Content-Type", $type);

            return $response;

        }

        if($type == 'PBD' && !empty($invitation_to_bid->file_location_pbd)){

            $path = $this->__static->archive_dir() .'/'. $invitation_to_bid->file_location_pbd;

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

        $invitation_to_bid = $this->invitation_to_bid_repo->findbySlug($slug);
        return view('dashboard.invitation_to_bid.edit')->with('invitation_to_bid', $invitation_to_bid);

    }







    public function update($request, $slug){

        $invitation_to_bid = $this->invitation_to_bid_repo->findbySlug($slug);
        
        $new_filename_itb = $this->__dataType::fileFilterReservedChar($request->description .'-'. $this->str->random(8), '.pdf');
        $new_filename_pbd = $this->__dataType::fileFilterReservedChar($request->description .'-'. $this->str->random(8), '.pdf');
        
        $dir_itb = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/INVITATION-TO-BID/ITB';
        $dir_pbd = $this->__dataType->date_parse($this->carbon->now(), 'Y') .'/INVITATION-TO-BID/PBD';

        $old_file_location_itb = $invitation_to_bid->file_location_itb;
        $old_file_location_pbd = $invitation_to_bid->file_location_pbd;
        
        $new_file_location_itb = $dir_itb .'/'. $new_filename_itb;
        $new_file_location_pbd = $dir_pbd .'/'. $new_filename_pbd;

        $file_location_itb = $old_file_location_itb;
        $file_location_pbd = $old_file_location_pbd;



        // if doc_file_itb has value
        if(!is_null($request->file('doc_file_itb'))){

            if ($this->storage->disk('local')->exists($old_file_location_itb)) {
                $this->storage->disk('local')->delete($old_file_location_itb);
            }
            
            $request->file('doc_file_itb')->storeAs($dir_itb, $new_filename_itb);
            $file_location_itb = $new_file_location_itb;

        // if description has change
        }elseif($request->description != $invitation_to_bid->description && $this->storage->disk('local')->exists($old_file_location_itb)){
            $this->storage->disk('local')->move($old_file_location_itb, $new_file_location_itb);
            $file_location_itb = $new_file_location_itb;
        }



        // if doc_file_pbd has value
        if(!is_null($request->file('doc_file_pbd'))){

            if ($this->storage->disk('local')->exists($old_file_location_pbd)) {
                $this->storage->disk('local')->delete($old_file_location_pbd);
            }
            
            $request->file('doc_file_pbd')->storeAs($dir_pbd, $new_filename_pbd);
            $file_location_pbd = $new_file_location_pbd;

        // if description has change
        }elseif($request->description != $invitation_to_bid->description && $this->storage->disk('local')->exists($old_file_location_pbd)){
            $this->storage->disk('local')->move($old_file_location_pbd, $new_file_location_pbd);
            $file_location_pbd = $new_file_location_pbd;
        }



        $invitation_to_bid = $this->invitation_to_bid_repo->update($request, $file_location_itb, $file_location_pbd, $invitation_to_bid);

        $this->event->fire('invitation_to_bid.update', $invitation_to_bid);
        return redirect()->route('dashboard.invitation_to_bid.index');

    }






    public function destroy($slug){

        $invitation_to_bid = $this->invitation_to_bid_repo->findbySlug($slug);

        if(!is_null($invitation_to_bid->file_location_itb)){

            if ($this->storage->disk('local')->exists($invitation_to_bid->file_location_itb)) {
                $this->storage->disk('local')->delete($invitation_to_bid->file_location_itb);
            }

        }

        if(!is_null($invitation_to_bid->file_location_pbd)){

            if ($this->storage->disk('local')->exists($invitation_to_bid->file_location_pbd)) {
                $this->storage->disk('local')->delete($invitation_to_bid->file_location_pbd);
            }

        }

        $invitation_to_bid = $this->invitation_to_bid_repo->destroy($invitation_to_bid);

        $this->event->fire('invitation_to_bid.destroy', $invitation_to_bid);
        return redirect()->back();

    }






}