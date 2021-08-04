<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Step;
use App\Models\Occurrence;
use App\Http\Resources\OccurrenceCardResource;

class WorkspaceController extends Controller
{
    public function index()
    {
        return view('workspace');
    }

    public function getSteps()
    {
        $sub = \DB::table('user_steps')
            ->whereRaw('user_steps.step_id = steps.id')
            ->whereRaw('user_steps.user_id = '.auth()->user()->id)
            ->selectRaw('count(*)');

        $steps = Step::orderBy('id')
            ->select(['id', 'name', 'prev_step', 'next_step', 'sector_id', 'created_at', \DB::raw("({$sub->toSql()}) as can")])
            ->with(['sector' => function ($query) {
                $query->select('id', 'name');
            }]);

        $allSteps = $steps->get();

        $firstStep = $steps->whereNull('prev_step')->first();

        $allSteps = $this->buildSteps($firstStep->id, $allSteps);

        $filteredSteps = [];

        foreach ($allSteps as $key => $value) {
            if ($value->can) {
                $filteredSteps[] = $value;
            }
        }

        return response()->json([
            'steps' => $filteredSteps
        ]);
    }

    private function buildSteps($stepId, $steps)
    {
        $ret = [];
        $steps->each(function ($item) use ($steps, $stepId, &$nextStep, &$ret) {
            if ($item->id === $stepId) {
                $ret[] = $item;
                if ($item->next_step) {
                    $ret = array_merge($ret, $this->buildSteps($item->next_step, $steps));
                }
                return false;
            }
        });
        return $ret;
    }

    public function getOccurrences()
    {
        $limit = 15;
        $occurrences = Occurrence::orderBy('id', 'desc')
            ->limit($limit)
            ->whereExists(function ($query) {
                $query->selectRaw(1)
                    ->from('transitions')
                    ->whereRaw('transitions.occurrence_id = occurrences.id')
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

        $occurrences = $occurrences->get();

        $occurrencesResource = OccurrenceCardResource::collection($occurrences);

        return response()->json([
            'verMais'    => count($occurrences) === $limit ? 1 : 0,
            'occurrences' => $occurrencesResource
        ]);
    }

    public function getOccurrence(int $id)
    {
        $occurrence = Occurrence::whereId($id)
            ->select(['id', 'title', 'person_id', 'contract_id', 'created_at'])
            ->first()
            ->load(['transitions' => function ($query) {
                $query->where('transitions.isactive', true)
                    ->with('user');
            }]);

        $occurrenceResource = OccurrenceCardResource::make($occurrence);

        return response()->json([
            'occurrence' => $occurrenceResource
        ]);
    }

    public function getStepsOptions()
    {
        $steps = Step::orderBy('id')
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
