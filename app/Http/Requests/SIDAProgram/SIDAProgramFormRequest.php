<?php

namespace App\Http\Requests\SIDAProgram;

use Illuminate\Foundation\Http\FormRequest;

class SIDAProgramFormRequest extends FormRequest{

    

    public function authorize(){

        return true;
    
    }

    
    
    public function rules(){

        return [
            
            'doc_file' => 'nullable|mimes:pdf|max:50000',
            'province_id' => 'required|max:11|string',
            'mill_district_id' => 'required|max:11|string',
            'sida_program_cat_id' => 'required|max:11|string',
            'year' => 'required|max:2100|int',
            'title' => 'required|max:255|string',
            
        ];
    
    }


    
}
