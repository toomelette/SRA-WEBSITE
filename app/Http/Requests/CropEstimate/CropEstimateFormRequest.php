<?php

namespace App\Http\Requests\CropEstimate;

use Illuminate\Foundation\Http\FormRequest;

class CropEstimateFormRequest extends FormRequest{

    

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
