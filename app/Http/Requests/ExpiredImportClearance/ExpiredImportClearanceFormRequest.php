<?php

namespace App\Http\Requests\ExpiredImportClearance;

use Illuminate\Foundation\Http\FormRequest;

class ExpiredImportClearanceFormRequest extends FormRequest{

    

    public function authorize(){

        return true;
    
    }

    
    public function rules(){

        return [
            
            'doc_file' => 'nullable|mimes:pdf|max:50000',
            'expired_import_clearance_cat_id' => 'required|max:11|string',
            'title' => 'required|max:255|string',
            'year' => 'required|max:2019|int',
            
        ];
    
    }



}
