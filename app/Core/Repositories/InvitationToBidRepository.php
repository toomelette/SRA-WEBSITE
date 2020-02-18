<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\InvitationToBidInterface;

use App\Models\InvitationToBid;


class InvitationToBidRepository extends BaseRepository implements InvitationToBidInterface {
	


    protected $invitation_to_bid;



	public function __construct(InvitationToBid $invitation_to_bid){

        $this->invitation_to_bid = $invitation_to_bid;
        parent::__construct();

    }





    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $invitations_to_bid = $this->cache->remember('invitations_to_bid:fetch:' . $key, 240, function() use ($request, $entries){

            $invitation_to_bid = $this->invitation_to_bid->newQuery();
            
            if(isset($request->q)){
                $this->search($invitation_to_bid, $request->q);
            }

            return $this->populate($invitation_to_bid, $entries);

        });

        return $invitations_to_bid;

    }





    public function store($request, $file_location_itb, $file_location_pbd){

        $invitation_to_bid = new InvitationToBid;
        $invitation_to_bid->slug = $this->str->random(16);
        $invitation_to_bid->invitation_to_bid_id = $this->getInvitationToBidIdInc();
        $invitation_to_bid->description = $request->description;
        $invitation_to_bid->station = $this->__dataType->string_to_boolean($request->station);
        $invitation_to_bid->date = $this->__dataType->date_parse($request->date);
        $invitation_to_bid->file_location_itb = $file_location_itb;
        $invitation_to_bid->file_location_pbd = $file_location_pbd;
        $invitation_to_bid->created_at = $this->carbon->now();
        $invitation_to_bid->updated_at = $this->carbon->now();
        $invitation_to_bid->ip_created = request()->ip();
        $invitation_to_bid->ip_updated = request()->ip();
        $invitation_to_bid->user_created = $this->auth->user()->user_id;
        $invitation_to_bid->user_updated = $this->auth->user()->user_id;
        $invitation_to_bid->save();
        
        return $invitation_to_bid;

    }





    public function update($request, $file_location_itb, $file_location_pbd, $invitation_to_bid){
      
        $invitation_to_bid->description = $request->description;
        $invitation_to_bid->station = $this->__dataType->string_to_boolean($request->station);
        $invitation_to_bid->date = $this->__dataType->date_parse($request->date);
        $invitation_to_bid->file_location_itb = $file_location_itb;
        $invitation_to_bid->file_location_pbd = $file_location_pbd;
        $invitation_to_bid->updated_at = $this->carbon->now();
        $invitation_to_bid->ip_updated = request()->ip();
        $invitation_to_bid->user_updated = $this->auth->user()->user_id;
        $invitation_to_bid->save();

        return $invitation_to_bid;

    }





    public function destroy($invitation_to_bid){

        $invitation_to_bid->delete();
        return $invitation_to_bid;

    }





    public function findBySlug($slug){

        $invitation_to_bid = $this->cache->remember('invitations_to_bid:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->invitation_to_bid->where('slug', $slug)->first();
        }); 
        
        if(empty($invitation_to_bid)){
            abort(404);
        }

        return $invitation_to_bid;

    }






    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('description', 'LIKE', '%'. $key .'%');
        });

    }





    public function populate($model, $entries){

        return $model->select('file_location_itb', 'file_location_pbd', 'description', 'station', 'date', 'slug')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate($entries);

    }






    public function getInvitationToBidIdInc(){

        $id = 'ITB10001';

        $invitation_to_bid = $this->invitation_to_bid->select('invitation_to_bid_id')->orderBy('invitation_to_bid_id', 'desc')->first();

        if($invitation_to_bid != null){

            if($invitation_to_bid->invitation_to_bid_id != null){
                $num = str_replace('ITB', '', $invitation_to_bid->invitation_to_bid_id) + 1;
                $id = 'ITB' . $num;
            }
        
        }
        
        return $id;
        
    }







}