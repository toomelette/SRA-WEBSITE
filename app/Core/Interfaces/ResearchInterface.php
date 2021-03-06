<?php

namespace App\Core\Interfaces;
 


interface ResearchInterface {

	public function fetch($request);

	public function guestFetch($request);

	public function store($request);

	public function update($request, $slug);

	public function destroy($slug);

	public function findBySlug($slug);
}