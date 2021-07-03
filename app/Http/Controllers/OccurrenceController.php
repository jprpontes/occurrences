<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Occurrence;
use App\Models\Transition;
use App\Models\User;
use App\Models\Step;
use App\Http\Resources\OccurrenceEditResource;

class OccurrenceController extends Controller
{
    public function edit(int $id)
    {
        $occurrence = Occurrence::find($id)
            ->load(['transitions' => function ($query) {
                $query->where('transitions.isactive', true)
                    ->with('user')
                    ->with(['step' => function ($query) {
                        $query->select(['id', 'name']);
                    }]);
            }]);
        $occurrenceResource = OccurrenceEditResource::make($occurrence);
        return response()->json([
            'occurrence' => $occurrenceResource
        ]);
    }

    public function toAssume(Request $request, int $id)
    {
        $occurrence = Occurrence::find($id);

        $lastTransition = Transition::where('occurrence_id', $occurrence->id)->latest()->first();

        try {
            \DB::beginTransaction();

            Transition::where('occurrence_id', $occurrence->id)
                ->update(['isactive' => false, 'close_date' => now()]);

            Transition::create([
                'occurrence_id' => $lastTransition->occurrence_id,
                'step_id'       => $lastTransition->step_id,
                'wasapproved'   => $lastTransition->wasapproved,
                'doc_due_date'  => $lastTransition->doc_due_date,
                'isactive'      => true,
                'user_id'       => auth()->user()->id,
            ]);

            \DB::commit();
        } catch (\Throwable $th) {
            \DB::rollback();
            throw $th;
        }

        $responsible = User::whereId(auth()->user()->id)
            ->select(['id', 'name'])
            ->first();

        return response()->json([
            'responsible' => $responsible
        ]);
    }

    public function getUsers()
    {
        $users = User::limit(10)
            ->select(['id', 'name']);

        if (request()->search) {
            $users = $users->where(function ($query) {
                $query->whereRaw("LOWER(name) like '%".strtolower(request()->search)."%'");
            });
        }

        return response()->json([
            'users' => $users->get()
        ]);
    }

    public function nextStep(int $id)
    {
        $occurrence = Occurrence::find($id);

        $lastTransition = Transition::where('occurrence_id', $occurrence->id)->latest()->first();

        $nextStep = Step::find($lastTransition->step_id)->nextStep()->select(['id', 'name'])->first();

        try {
            \DB::beginTransaction();

            Transition::where('occurrence_id', $occurrence->id)
                ->update(['isactive' => false, 'close_date' => now()]);

            Transition::create([
                'occurrence_id' => $lastTransition->occurrence_id,
                'step_id'       => $nextStep->id,
                'wasapproved'   => $lastTransition->wasapproved,
                'doc_due_date'  => $lastTransition->doc_due_date,
                'isactive'      => true,
                'user_id'       => $lastTransition->user_id,
            ]);

            \DB::commit();
        } catch (\Throwable $th) {
            \DB::rollback();
            throw $th;
        }

        return response()->json([
            'newStep' => $nextStep
        ]);
    }

    public function changeStep(Request $request, int $id)
    {
        $occurrence = Occurrence::find($id);

        $lastTransition = Transition::where('occurrence_id', $occurrence->id)->latest()->first();

        $newStep = Step::find($request->newStepId);

        try {
            \DB::beginTransaction();

            Transition::where('occurrence_id', $occurrence->id)
                ->update(['isactive' => false, 'close_date' => now()]);

            Transition::create([
                'occurrence_id' => $lastTransition->occurrence_id,
                'step_id'       => $newStep->id,
                'wasapproved'   => $lastTransition->wasapproved,
                'doc_due_date'  => $lastTransition->doc_due_date,
                'isactive'      => true,
                'user_id'       => $lastTransition->user_id,
            ]);

            \DB::commit();
        } catch (\Throwable $th) {
            \DB::rollback();
            throw $th;
        }
    }

    public function changeResponsible(Request $request, int $id)
    {
        $occurrence = Occurrence::find($id);

        $lastTransition = Transition::where('occurrence_id', $occurrence->id)->latest()->first();

        $newResponsible = User::find($request->newResponsibleId);

        try {
            \DB::beginTransaction();

            Transition::where('occurrence_id', $occurrence->id)
                ->update(['isactive' => false, 'close_date' => now()]);

            Transition::create([
                'occurrence_id' => $lastTransition->occurrence_id,
                'step_id'       => $lastTransition->step_id,
                'wasapproved'   => $lastTransition->wasapproved,
                'doc_due_date'  => $lastTransition->doc_due_date,
                'isactive'      => true,
                'user_id'       => $newResponsible ? $newResponsible->id : null,
            ]);

            \DB::commit();
        } catch (\Throwable $th) {
            \DB::rollback();
            throw $th;
        }
    }

    public function changeExpectation(Request $request, int $id)
    {
        $occurrence = Occurrence::find($id);

        $lastTransition = Transition::where('occurrence_id', $occurrence->id)->latest()->first();

        $newDocDueDate = $request->newExpectation;

        try {
            \DB::beginTransaction();

            Transition::where('occurrence_id', $occurrence->id)
                ->update(['isactive' => false, 'close_date' => now()]);

            Transition::create([
                'occurrence_id' => $lastTransition->occurrence_id,
                'step_id'       => $lastTransition->step_id,
                'wasapproved'   => $lastTransition->wasapproved,
                'doc_due_date'  => $newDocDueDate,
                'isactive'      => true,
                'user_id'       => $lastTransition->user_id,
            ]);

            \DB::commit();
        } catch (\Throwable $th) {
            \DB::rollback();
            throw $th;
        }
    }
}
