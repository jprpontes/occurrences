<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserStepController extends Controller
{
    public function getUsers()
    {
        $limit = 5;
        $users = User::leftJoin('user_steps', 'user_steps.user_id', 'users.id')
            ->where(function ($query) {
                $query->where('user_steps.step_id', request()->stepId)
                    ->orWhereNull('user_steps.step_id');
            })
            ->orderBy('users.name')
            ->offset(request()->offset ?? 0)
            ->limit($limit)
            ->select(['users.id', 'users.name', 'users.email', DB::raw('CASE WHEN user_steps.id IS NULL THEN 0 ELSE 1 END as adicionado')]);

        if (request()->search) {
            $users = $users->where(function ($query) {
                $query->whereRaw("LOWER(users.name) like '%".strtolower(request()->search)."%'");
                $query->orWhereRaw("LOWER(users.email) like '%".strtolower(request()->search)."%'");
            });
        }

        $users = $users->get();

        return response()->json([
            'verMais' => count($users) === $limit ? 1 : 0,
            'users' => $users
        ]);
    }
}
