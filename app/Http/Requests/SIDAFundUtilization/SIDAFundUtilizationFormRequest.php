<?php

namespace App\Http\Requests\SIDAFundUtilization;

use Illuminate\Foundation\Http\FormRequest;

class SIDAFundUtilizationFormRequest extends FormRequest{

    

    public function authorize(){

        return true;
    
    }

    
    public function rules(){

        return [
            
            'doc_file' => 'nullable|mimes:pdf|max:50000',
            'title' => 'required|max:90|string',
            'description' => 'required|max:255|string',
            
        ];
    
    }



}
