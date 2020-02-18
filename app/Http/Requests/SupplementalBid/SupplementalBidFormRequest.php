<?php

namespace App\Http\Requests\SupplementalBid;

use Illuminate\Foundation\Http\FormRequest;

class SupplementalBidFormRequest extends FormRequest{

    


    public function authorize(){

        return true;
    
    }

    
    public function rules(){

        return [
            
            'doc_file' => 'nullable|mimes:pdf|max:50000',
            'description' => 'required|max:255|string',
            'station' => 'required|max:5|string',
            'date' => 'required|date_format:"m/d/Y"',
            
        ];
    
    } 
    



}
