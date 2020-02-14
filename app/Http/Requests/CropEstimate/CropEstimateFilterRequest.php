<?php

namespace App\Http\Requests\CropEstimate;

use Illuminate\Foundation\Http\FormRequest;

class CropEstimateFilterRequest extends FormRequest{

    

    public function authorize(){

        return true;
    
    }

    
    public function rules(){

        return [
            
            'q' => 'nullable|max:90|string',
            
        ];
    
    }



}
