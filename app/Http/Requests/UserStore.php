<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use App\Models\User;

class UserStore extends FormRequest
{
    public function rules()
    {
        return [
            'name'         => 'required',
            'email'        => 'required|email',
            'sector_id'    => 'required|numeric',
            'password'     => 'required',
            'passwordMode' => 'required',
        ];
    }

    public function prepareForValidation()
    {
        $data = $this->all();

        if ($this->passwordMode === 'RANDOM') {
            $data['password'] = Str::random(User::PASSWORD_MIN_SIZE);
        }

        $this->replace($data);
    }
}
