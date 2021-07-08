<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskStore extends FormRequest
{
    public function rules()
    {
        return [
            'occurrence_id' => 'required',
            'activity_id'   => 'required',
            'date'          => 'required',
            'user_id'       => 'required',
        ];
    }
}
