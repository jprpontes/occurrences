<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Step;
use App\Models\Ocurrence;
use App\Http\Resources\OcurrenceCardResource;

class WorkspaceController extends Controller
{
    public function index()
    {
        return view('workspace');
    }

    public function getSteps()
    {
        $steps = Step::orderBy('id', 'desc')
            ->whereExists(function ($query) {
                $query->selectRaw(1)
                    ->from('user_steps')
                    ->whereRaw('user_steps.step_id = steps.id')
                    ->where('user_steps.user_id', auth()->user()->id);
            })
            ->select(['id', 'name', 'sector_id', 'created_at']);

        $steps = $steps->get();

        return response()->json([
            'steps'   => $steps
        ]);
    }

    public function getOcurrences()
    {
        $limit = 15;
        $ocurrences = Ocurrence::orderBy('id', 'desc')
            ->limit($limit)
            ->whereExists(function ($query) {
                $query->selectRaw(1)
                    ->from('transitions')
                    ->whereRaw('transitions.ocurrence_id = ocurrences.id')
                    ->where('transitions.step_id', request()->stepId)
                    ->where('transitions.isactive', true);
            })
            ->select(['id', 'title', 'person_id', 'contract_id', 'created_at'])
            ->with(['transitions' => function ($query) {
                $query->where('transitions.step_id', request()->stepId)
                    ->where('transitions.isactive', true)
                    ->with('user');
            }]);

        // if (request()->search) {
        //     $steps = $steps->where(function ($query) {
        //         $query->whereRaw("LOWER(name) like '%".strtolower(request()->search)."%'");
        //     });
        // }

        $ocurrences = $ocurrences->get();

        $ocurrencesResource = OcurrenceCardResource::collection($ocurrences);

        return response()->json([
            'verMais'    => count($ocurrences) === $limit ? 1 : 0,
            'ocurrences' => $ocurrencesResource
        ]);
    }

    public function getStepsOptions()
    {
        $steps = Step::orderBy('id', 'desc')
            ->whereExists(function ($query) {
                $query->selectRaw(1)
                    ->from('user_steps')
                    ->whereRaw('user_steps.step_id = steps.id')
                    ->where('user_steps.user_id', auth()->user()->id);
            })
            ->select(['id', 'name']);

        $steps = $steps->get();

        return response()->json([
            'steps'   => $steps
        ]);
    }
}
