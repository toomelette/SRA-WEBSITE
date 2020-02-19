<?php

namespace App\Http\Requests\MinutesOfTheBid;

use Illuminate\Foundation\Http\FormRequest;

class MinutesOfTheBidFormRequest extends FormRequest{

    


    public function authorize(){

        return true;
    
    }

    
    public function rules(){

        return [
            
            'doc_file' => 'nullable|mimes:pdf|max:50000',
            'title' => 'required|max:255|string',
            'location' => 'required|max:255|string',
            'date' => 'required|date_format:"m/d/Y"',
            
        ];
    
    } 




}
