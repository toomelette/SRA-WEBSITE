<?php

namespace App\Http\Requests\MillDistrict;

use Illuminate\Foundation\Http\FormRequest;

class MillDistrictFormRequest extends FormRequest{

    

    public function authorize(){

        return true;
    
    }

    
    public function rules(){

        return [

            'province_id' => 'required|max:11|string',
            'name' => 'required|max:255|string',
            
        ];
    
    }




}
