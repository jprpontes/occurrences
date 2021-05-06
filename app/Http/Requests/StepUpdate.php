<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StepUpdate extends FormRequest
{
    public function rules()
    {
        return [
            'name'      => 'required',
            'sector_id' => 'required',
        ];
    }
}
