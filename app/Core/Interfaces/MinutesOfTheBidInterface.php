<?php

namespace App\Core\Interfaces;
 


interface MinutesOfTheBidInterface {

	public function fetch($request);

	public function guestFetch($request);

	public function store($request, $file_location);

	public function update($request, $file_location, $motb);

	public function destroy($motb);

	public function findBySlug($slug);
		
}