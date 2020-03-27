<?php

namespace App\Core\Interfaces;
 


interface NewsInterface {

	public function fetch($request);

	public function guestFetch($request);

	public function guestFetchInHome();

	public function store($request, $file_location, $img_location);

	public function update($request, $file_location, $img_location, $news);

	public function destroy($news);

	public function findBySlug($slug);
		
}