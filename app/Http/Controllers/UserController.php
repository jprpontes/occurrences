<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Sector;
use App\Http\Requests\UserStore;
use App\Http\Requests\UserUpdate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('users');
    }

    public function getUsers()
    {
        $limit = 15;
        $users = User::orderBy('id', 'desc')
            ->offset(request()->offset ?? 0)
            ->limit($limit)
            ->select(['id', 'name', 'email', 'created_at']);

        if (request()->search) {
            $users = $users->where(function ($query) {
                $query->whereRaw("LOWER(name) like '%".strtolower(request()->search)."%'");
                $query->orWhereRaw("LOWER(email) like '%".strtolower(request()->search)."%'");
            });
        }

        $users = $users->get();

        return response()->json([
            'verMais' => count($users) === $limit ? 1 : 0,
            'users' => $users
        ]);
    }

    public function create()
    {
        // $sectors = Sector::orderBy('name')
        //     ->select(['id', 'name'])
        //     ->get();

        // return response()->json([
        //     'sectors' => $sectors
        // ]);
    }

    public function edit(int $id)
    {
        // $sectors = Sector::orderBy('name')
        // ->select(['id', 'name'])
        // ->get();

        $user = User::select(['id', 'name', 'email'])->whereId($id)->first();

        return response()->json([
            // 'sectors' => $sectors,
            'user'    => $user
        ]);
    }

    public function store(UserStore $request)
    {
        $data             = $request->all();
        $data['password'] = Hash::make($data['password']);

        $newUser = User::create($data);

        // Enviar email.
    }

    public function update(int $id, UserUpdate $request)
    {
        $data = $request->all();

        if ($request->passwordMode !== 'NAO_REDEFINIR') {
            $data['password'] = Hash::make($data['password']);
        }

        $updatedUser = User::find($id)->update($data);
    }
}
