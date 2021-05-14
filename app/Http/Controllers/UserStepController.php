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
        $users = User::orderBy('users.name')
            ->offset(request()->offset ?? 0)
            ->limit($limit)
            ->select(['users.id', 'users.name', 'users.email']);

        if (request()->search) {
            $users = $users->where(function ($query) {
                $query->whereRaw("LOWER(users.name) like '%".strtolower(request()->search)."%'");
                $query->orWhereRaw("LOWER(users.email) like '%".strtolower(request()->search)."%'");
            });
        }

        if (request()->filter && request()->stepId) {
            if (request()->filter === 'ALLOWEDS') {
                $users = $users->whereExists(function ($query) {
                    $query->selectRaw(1)
                        ->from('user_steps')
                        ->whereRaw('user_steps.user_id = users.id')
                        ->where('user_steps.step_id', request()->stepId);
                });
            }
        }

        $users = $users->get();

        return response()->json([
            'verMais' => count($users) === $limit ? 1 : 0,
            'users' => $users
        ]);
    }
}
