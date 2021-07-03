<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Step;
use App\Models\Sector;
use App\Models\UserStep;
use App\Http\Requests\StepStore;
use App\Http\Requests\StepUpdate;

class StepController extends Controller
{
    public function index()
    {
        return view('steps');
    }

    public function getSteps()
    {
        $limit = 15;
        $steps = Step::orderBy('id', 'desc')
            ->offset(request()->offset ?? 0)
            ->limit($limit)
            ->select(['id', 'name', 'sector_id', 'created_at'])
            ->with(['sector' => function ($query) {
                $query->select(['id', 'name']);
            }]);

        if (request()->search) {
            $steps = $steps->where(function ($query) {
                $query->whereRaw("LOWER(name) like '%".strtolower(request()->search)."%'");
            });
        }

        $steps = $steps->get();

        return response()->json([
            'verMais' => count($steps) === $limit ? 1 : 0,
            'steps'   => $steps
        ]);
    }

    public function create()
    {
        $sectors = Sector::orderBy('name')
            ->select(['id', 'name'])
            ->get();

        return response()->json([
            'sectors' => $sectors
        ]);
    }

    public function edit(int $id)
    {
        $step = Step::select(['id', 'name', 'sector_id', 'prev_step', 'next_step'])
            ->with(['prevStep' => function ($query) {
                $query->select(['id', 'name']);
            }])
            ->with(['nextStep' => function ($query) {
                $query->select(['id', 'name']);
            }])
            ->whereId($id)
            ->first();

        $sectors = Sector::orderBy('name')
            ->select(['id', 'name'])
            ->get();

        $stepUsers = $step->users()->select('users.id')->get()->pluck('id');

        return response()->json([
            'step'      => $step,
            'sectors'   => $sectors,
            'stepUsers' => $stepUsers
        ]);
    }

    public function store(StepStore $request)
    {
        $data = $request->all();
        $step = Step::create($data);

        if ($request->step_users) {
            foreach ($request->step_users as $key => $user_id) {
                UserStep::firstOrCreate([
                    'step_id' => $step->id,
                    'user_id' => $user_id
                ]);
            }
        }
    }

    public function update(int $id, StepUpdate $request)
    {
        $data = $request->all();
        Step::find($id)->update($data);

        if ($request->step_users) {
            foreach ($request->step_users as $key => $user_id) {
                UserStep::firstOrCreate([
                    'step_id' => $id,
                    'user_id' => $user_id
                ]);
            }
        }
        UserStep::where('step_id', $id)->whereNotIn('user_id', $request->step_users ?? [])->delete();
    }

    public function getStepsToPrevNext()
    {
        $limit = 15;
        $steps = Step::limit($limit)
            ->select(['id', 'name']);

        if (request()->search) {
            $steps = $steps->where(function ($query) {
                $query->whereRaw("LOWER(name) like '%".strtolower(request()->search)."%'");
            });
        }

        $steps = $steps->get();

        return response()->json([
            'steps' => $steps
        ]);
    }
}
