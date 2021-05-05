<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SectorUpdate extends FormRequest
{
    public function rules()
    {
        return [
            'name'          => 'required',
            'document_type' => 'required',
        ];
    }
}
