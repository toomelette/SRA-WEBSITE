<?php

namespace App\Http\Requests\MillingSchedule;

use Illuminate\Foundation\Http\FormRequest;

class MillingScheduleFilterRequest extends FormRequest{

    

    public function authorize(){

        return true;
    
    }

    
    public function rules(){

        return [
            
            'q' => 'nullable|max:90|string',
            
        ];
    
    }



}
