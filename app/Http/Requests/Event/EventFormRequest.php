<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class EventFormRequest extends FormRequest{

    

    public function authorize(){

        return true;
    
    }

    
    public function rules(){

        return [
            
            'doc_file' => 'nullable|mimes:pdf|max:50000',
            'station_id' => 'required|max:11|string',
            'title' => 'required|max:90|string',
            'description' => 'required|max:255|string',
            'date_from' => 'required|date_format:"m/d/Y"',
            'date_to' => 'required|date_format:"m/d/Y"',
            
        ];
    
    }



}
