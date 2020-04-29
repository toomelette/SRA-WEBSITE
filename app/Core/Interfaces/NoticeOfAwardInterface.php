<?php

namespace App\Core\Interfaces;
 


interface NoticeOfAwardInterface {

	public function fetch($request);

	public function guestFetch($request);

	public function store($request, $file_location_noa, $file_location_bacreso);

	public function update($request, $file_location_noa, $file_location_bacreso, $notice_of_award);

	public function destroy($notice_of_award);

	public function findBySlug($slug);
		
}