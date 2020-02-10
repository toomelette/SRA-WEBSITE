<?php

namespace App\Http\Requests\SMSForm;

use Illuminate\Foundation\Http\FormRequest;

class SMSFormFormRequest extends FormRequest{

    

    public function authorize(){

        return true;
    
    }

    
    public function rules(){

        return [
            
            'doc_file' => 'nullable|mimes:pdf|max:50000',
            'title' => 'required|max:255|string',
            'description' => 'required|max:255|string',
            
        ];
    
    }


    
}
