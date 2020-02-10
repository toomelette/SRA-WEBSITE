<?php

namespace App\Http\Requests\Administrator;

use Illuminate\Foundation\Http\FormRequest;

class AdministratorFormRequest extends FormRequest{

    

    public function authorize(){

        return true;
    
    }

    
    public function rules(){

        return [
            
            'doc_file' => 'nullable|mimes:jpg,jpeg,png|max:50000',
            'fullname' => 'required|max:255|string',
            'date_scope' => 'required|max:255|string',
            
        ];
    
    }



}
