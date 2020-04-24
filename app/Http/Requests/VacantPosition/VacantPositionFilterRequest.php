<?php

namespace App\Http\Requests\VacantPosition;

use Illuminate\Foundation\Http\FormRequest;

class VacantPositionFilterRequest extends FormRequest{

    

    public function authorize(){

        return true;
    
    }

    
    public function rules(){

        return [
            'q' => 'nullable|max:90|string', 
        ];
    
    }



}
