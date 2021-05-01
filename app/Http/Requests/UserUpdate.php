<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdate extends FormRequest
{
    public function rules()
    {
        return [
            'name'      => 'required',
            'email'     => 'required|email',
            'sector_id' => 'required|numeric',
        ];
    }
}
