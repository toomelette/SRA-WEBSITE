<?php

namespace App\Core\Interfaces;
 


interface InvitationToBidInterface {

	public function fetch($request);

	public function store($request, $file_location_itb, $file_location_pbd);

	public function update($request, $file_location_itb, $file_location_pbd, $invitation_to_bid);

	public function destroy($invitation_to_bid);

	public function findBySlug($slug);
		
}