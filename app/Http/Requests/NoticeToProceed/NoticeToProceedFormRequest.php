<?php

namespace App\Http\Requests\NoticeToProceed;

use Illuminate\Foundation\Http\FormRequest;

class NoticeToProceedFormRequest extends FormRequest{

    

    public function authorize(){

        return true;
    
    }

    
    public function rules(){

        return [
            
            'doc_file_ntp' => 'nullable|mimes:pdf|max:50000',
            'doc_file_po' => 'nullable|mimes:pdf|max:50000',
            'description' => 'required|max:255|string',
            'station' => 'required|max:5|string',
            'date' => 'required|date_format:"m/d/Y"',
            
        ];
    
    }




}
