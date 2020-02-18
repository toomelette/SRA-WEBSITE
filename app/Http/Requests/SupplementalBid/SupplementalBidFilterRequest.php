<?php

namespace App\Http\Requests\SupplementalBid;

use Illuminate\Foundation\Http\FormRequest;

class SupplementalBidFilterRequest extends FormRequest{

    


    public function authorize(){

        return true;
    
    }



    
    public function rules(){

        return [
            
            'q' => 'nullable|max:90|string',
        ];

    
    } 




}
