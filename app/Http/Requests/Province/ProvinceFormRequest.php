<?php

namespace App\Http\Requests\Province;

use Illuminate\Foundation\Http\FormRequest;

class ProvinceFormRequest extends FormRequest{

    

    public function authorize(){

        return true;
    
    }

    
    public function rules(){

        return [

            'name' => 'required|max:255|string',
            
        ];
    
    }



}
