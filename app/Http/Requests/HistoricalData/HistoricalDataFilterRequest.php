<?php

namespace App\Http\Requests\HistoricalData;

use Illuminate\Foundation\Http\FormRequest;

class HistoricalDataFilterRequest extends FormRequest{


    
    public function authorize(){

        return true;
    
    }

    
    public function rules(){
        
        return [
            
            'q' => 'nullable|string|max:90',
            
        ];

    }



}
