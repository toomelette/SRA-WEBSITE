<?php

namespace App\Http\Requests\Official;

use Illuminate\Foundation\Http\FormRequest;

class OfficialFilterRequest extends FormRequest{

    

    public function authorize(){

        return true;
    
    }


    
    public function rules(){

        return [

            'q' => 'nullable|string|max:90',
            
        ];
    
    }




}
