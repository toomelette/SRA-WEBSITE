<?php

namespace App\Http\Requests\Office;

use Illuminate\Foundation\Http\FormRequest;

class OfficeFormRequest extends FormRequest{

    

    public function authorize(){

        return true;
    
    }

    
    public function rules(){

        return [
            
            'seq_no' => 'required|int|max:20',
            'name' => 'required|string|max:255',
            
        ];
    
    }



}
