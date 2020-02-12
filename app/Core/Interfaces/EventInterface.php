<?php

namespace App\Core\Interfaces;
 


interface EventInterface {

	public function fetch($request);

	public function store($request, $file_location);

	public function update($request, $file_location, $event);

	public function destroy($event);

	public function findBySlug($slug);
		
}