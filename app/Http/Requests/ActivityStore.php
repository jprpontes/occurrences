<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActivityStore extends FormRequest
{
    public function rules()
    {
        return [
            'name'      => 'required',
            'sector_id' => 'required',
        ];
    }
}
