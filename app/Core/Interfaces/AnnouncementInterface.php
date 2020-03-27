<?php

namespace App\Core\Interfaces;
 


interface AnnouncementInterface {

	public function fetch($request);

	public function guestFetch($request);

	public function guestFetchInHome();

	public function store($request, $file_location);

	public function update($request, $file_location, $news);

	public function destroy($news);

	public function findBySlug($slug);
		
}