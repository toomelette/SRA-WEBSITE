<?php

namespace App\Http\Controllers;

use App\Core\Services\InvitationToBidService;
use App\Http\Requests\InvitationToBid\InvitationToBidFormRequest;
use App\Http\Requests\InvitationToBid\InvitationToBidFilterRequest;

class InvitationToBidController extends Controller{


	protected $invitation_to_bid;



    public function __construct(InvitationToBidService $invitation_to_bid){

        $this->invitation_to_bid = $invitation_to_bid;

    }


    
    public function index(InvitationToBidFilterRequest $request){
        
        return $this->invitation_to_bid->fetch($request);

    }

    

    public function create(){
        
        return view('dashboard.invitation_to_bid.create');

    }

   

    public function store(InvitationToBidFormRequest $request){
        
        return $this->invitation_to_bid->store($request);

    }
 



    public function viewFile($slug, $type){
        
        return $this->invitation_to_bid->viewFile($slug, $type);

    }
 



    public function edit($slug){
        
        return $this->invitation_to_bid->edit($slug);

    }




    public function update(InvitationToBidFormRequest $request, $slug){
        
        return $this->invitation_to_bid->update($request, $slug);

    }

    


    public function destroy($slug){
        
        return $this->invitation_to_bid->destroy($slug);

    }


    
}
