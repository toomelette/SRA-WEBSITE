<?php

namespace App\Core\Interfaces;
 


interface AdminCornerInterface {

	public function fetch($request);

	//public function guestFetch($request);

	public function store($request, $img_location);

	public function update($request, $img_location, $news);

	public function destroy($news);

	public function findBySlug($slug);
		
}