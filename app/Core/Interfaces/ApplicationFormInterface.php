<?php

namespace App\Core\Interfaces;
 


interface ApplicationFormInterface {

	public function fetch($request);

	public function store($request, $file_location);

	public function update($request, $file_location, $news);

	public function destroy($news);

	public function findBySlug($slug);
		
}