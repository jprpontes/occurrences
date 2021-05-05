<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SectorStore extends FormRequest
{
    public function rules()
    {
        return [
            'name'          => 'required',
            'document_type' => 'required',
        ];
    }
}
