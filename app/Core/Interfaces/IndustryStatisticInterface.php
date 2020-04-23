<?php

namespace App\Core\Interfaces;
 


interface IndustryStatisticInterface {

	public function fetch($request);

	public function guestFetchByCatId($cat_id, $request);

	public function store($request, $file_location);

	public function update($request, $file_location, $news);

	public function destroy($news);

	public function findBySlug($slug);
		
}