<?php

namespace App\Http\Requests\IndustryStatistic;

use Illuminate\Foundation\Http\FormRequest;

class IndustryStatisticFormRequest extends FormRequest{

    

    public function authorize(){

        return true;
    
    }

    
    public function rules(){

        return [
            
            'doc_file' => 'nullable|mimes:pdf|max:50000',
            'crop_year_id' => 'required|max:11|string',
            'industry_statistics_category_id' => 'required|max:11|string',
            'title' => 'required|max:255|string',
            'cut_off_date' => 'required|date_format:"m/d/Y"',
            
        ];
    
    }



}
