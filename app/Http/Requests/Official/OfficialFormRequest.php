<?php

namespace App\Http\Requests\Official;

use Illuminate\Foundation\Http\FormRequest;

class OfficialFormRequest extends FormRequest{


    

    public function authorize(){

        return true;
    
    }

    
    public function rules(){

        return [

            'doc_file' => 'nullable|mimes:jpg,jpeg,png|max:50000',
            'office_id' => 'required|max:11|string',
            'station_id' => 'required|max:11|string',
            'fullname' => 'required|max:255|string',
            'position' => 'required|max:255|string',
            'email' => 'nullable|max:90|email',
            'contact_no' => 'nullable|max:45|string',
            
        ];
    
    }



}
