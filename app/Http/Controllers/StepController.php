<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Step;
use App\Models\Sector;
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
        $step = Step::select(['id', 'name', 'sector_id'])->whereId($id)->first();

        $sectors = Sector::orderBy('name')
            ->select(['id', 'name'])
            ->get();

        return response()->json([
            'step'    => $step,
            'sectors' => $sectors
        ]);
    }

    public function store(StepStore $request)
    {
        $data = $request->all();
        Step::create($data);
    }

    public function update(int $id, StepUpdate $request)
    {
        $data = $request->all();
        Step::find($id)->update($data);
    }
}
