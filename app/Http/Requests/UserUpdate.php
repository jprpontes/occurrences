<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdate extends FormRequest
{
    public function rules()
    {
        return [
            'name'         => 'required',
            'email'        => 'required|email',
            // 'sector_id'    => 'required|numeric',
            'passwordMode' => 'required',
        ];
    }

    public function prepareForValidation()
    {
        $data = $this->all();

        if ($this->passwordMode === 'RANDOM') {
            $data['password'] = Str::random(User::PASSWORD_MIN_SIZE);
        } elseif ($this->passwordMode === 'NAO_REDEFINIR') {
            unset($data['password']);
        }

        $this->replace($data);
    }
}
