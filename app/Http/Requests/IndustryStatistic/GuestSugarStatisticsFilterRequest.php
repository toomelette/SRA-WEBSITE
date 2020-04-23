<?php

namespace App\Http\Requests\IndustryStatistic;

use Illuminate\Foundation\Http\FormRequest;

class GuestSugarStatisticsFilterRequest extends FormRequest{


    
    public function authorize(){

        return true;
    
    }

    
    public function rules(){
        
        return [
            
            'q' => 'nullable|string|max:90',
            
        ];

    }


    
}
