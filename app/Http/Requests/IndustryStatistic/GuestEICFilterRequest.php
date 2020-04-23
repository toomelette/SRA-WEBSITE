<?php

namespace App\Http\Requests\IndustryStatistic;

use Illuminate\Foundation\Http\FormRequest;

class GuestEICFilterRequest extends FormRequest{


    
    public function authorize(){

        return true;
    
    }

    
    public function rules(){
        
        return [
            
            'q' => 'nullable|string|max:90',
            
        ];

    }


    
}
