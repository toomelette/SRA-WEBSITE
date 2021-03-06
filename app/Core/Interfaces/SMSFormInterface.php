<?php

namespace App\Core\Interfaces;
 


interface SMSFormInterface {

	public function fetch($request);

	public function guestFetch($request);

	public function store($request, $file_location);

	public function update($request, $file_location, $sms_form);

	public function destroy($sms_form);

	public function findBySlug($slug);
		
}