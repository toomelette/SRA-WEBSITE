<?php

namespace App\Http\Requests\SIDAGuideline;

use Illuminate\Foundation\Http\FormRequest;

class SIDAGuidelineFormRequest extends FormRequest{

    

    public function authorize(){

        return true;
    
    }

    
    public function rules(){

        return [
            
            'doc_file' => 'nullable|mimes:pdf|max:50000',
            'title' => 'required|max:90|string',
            'year' => 'required|max:2100|int',
            'description' => 'required|max:255|string',
            
        ];
    
    }




}
