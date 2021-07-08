<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskUpdate extends FormRequest
{
    public function rules()
    {
        return [
            'activity_id' => 'required',
            'date'        => 'required',
            'user_id'     => 'required',
        ];
    }
}
