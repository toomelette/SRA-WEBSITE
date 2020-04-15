<?php

namespace App\Core\Interfaces;
 


interface VarietyInterface {

	public function fetch($request);

	public function guestFetch($request);

	public function store($request, $file_location);

	public function update($request, $file_location, $news);

	public function destroy($variety);

	public function findBySlug($slug);
		
}