<?php

namespace App\Core\Interfaces;
 


interface VacantPositionInterface {

	public function fetch($request);

	public function guestFetch($request);

	public function store($request, $file_location);

	public function update($request, $file_location, $vacant_position);

	public function destroy($vacant_position);

	public function findBySlug($slug);
		
}