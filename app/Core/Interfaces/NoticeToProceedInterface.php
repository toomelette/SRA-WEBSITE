<?php

namespace App\Core\Interfaces;
 


interface NoticeToProceedInterface {

	public function fetch($request);

	public function guestFetch($request);

	public function store($request, $file_location_ntp, $file_location_po);

	public function update($request, $file_location_ntp, $file_location_po, $notice_to_proceed);

	public function destroy($notice_to_proceed);

	public function findBySlug($slug);
		
}