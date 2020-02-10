<?php

namespace App\Http\Requests\Administrator;

use Illuminate\Foundation\Http\FormRequest;

class AdministratorFilterRequest extends FormRequest{

    

    public function authorize(){

        return true;
    
    }


    
    public function rules(){

        return [

            'q' => 'nullable|string|max:90',
            
        ];
    
    }


    
}
