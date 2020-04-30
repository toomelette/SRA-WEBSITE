<?php

namespace App\Http\Requests\AdminCorner;

use Illuminate\Foundation\Http\FormRequest;

class AdminCornerFormRequest extends FormRequest{

    

    public function authorize(){

        return true;
    
    }

    
    public function rules(){

        return [

            'type' => 'required|max:1|string',
            'title' => 'required|max:90|string',
            'img_file' => 'nullable|mimes:jpg,jpeg,png|max:50000',
            'content' => 'required',

        ];
    
    }



}
