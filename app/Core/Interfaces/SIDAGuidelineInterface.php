<?php

namespace App\Core\Interfaces;
 


interface SIDAGuidelineInterface {

	public function fetch($request);

	public function guestFetch($request);

	public function store($request, $file_location);

	public function update($request, $file_location, $policy);

	public function destroy($news);

	public function findBySlug($slug);
		
}