<?php

namespace App\Http\Requests\MillingSchedule;

use Illuminate\Foundation\Http\FormRequest;

class MillingScheduleFormRequest extends FormRequest{

    

    public function authorize(){

        return true;
    
    }

    
    public function rules(){

        return [
            
            'doc_file' => 'nullable|mimes:pdf|max:50000',
            'title' => 'required|max:255|string',
            
        ];
    
    }



}
