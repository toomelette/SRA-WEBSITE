<?php

namespace App\Http\Requests\Policy;

use Illuminate\Foundation\Http\FormRequest;

class PolicyFormRequest extends FormRequest{

    

    public function authorize(){

        return true;
    
    }

    
    public function rules(){

        return [
            
            'doc_file' => 'nullable|mimes:pdf|max:50000',
            'crop_year_id' => 'required|max:11|string',
            'policy_category_id' => 'required|max:11|string',
            'title' => 'required|max:255|string',
            
        ];
    
    }


}
