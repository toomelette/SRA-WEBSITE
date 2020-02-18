<?php

namespace App\Http\Requests\InvitationToBid;

use Illuminate\Foundation\Http\FormRequest;

class InvitationToBidFormRequest extends FormRequest{

    

    public function authorize(){

        return true;
    
    }

    
    public function rules(){

        return [
            
            'doc_file_itb' => 'nullable|mimes:pdf|max:50000',
            'doc_file_pbd' => 'nullable|mimes:pdf|max:50000',
            'description' => 'required|max:255|string',
            'station' => 'required|max:5|string',
            'date' => 'required|date_format:"m/d/Y"',
            
        ];
    
    }



}
