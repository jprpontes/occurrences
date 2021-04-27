<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return view('users');
    }

    public function pagination()
    {
        $limit = 15;
        $users = User::orderBy('id', 'desc')->offset(request()->offset ?? 0)->limit($limit)->get();
        return response()->json([
            'verMais' => count($users) === $limit ? 1 : 0,
            'users' => $users->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'created_at' => $user->created_at
                ];
            })
        ]);
    }
}
