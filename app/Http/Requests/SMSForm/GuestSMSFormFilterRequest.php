<?php

namespace App\Http\Requests\SMSForm;

use Illuminate\Foundation\Http\FormRequest;

class GuestSMSFormFilterRequest extends FormRequest{

    
    public function authorize(){

        return true;

    }

    
    public function rules(){

        return [

            'q' => 'nullable|max:90|string',
            'e' => 'nullable|max:100|numeric',
            'page' => 'nullable|max:50|numeric',
            'sort' => 'nullable|max:45|string',
            'direction' => 'nullable|max:5|string',
            
        ];

    }


}
