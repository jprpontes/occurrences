<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Occurrence;
use App\Models\Transition;
use App\Models\User;
use App\Http\Resources\OccurrenceEditResource;

class OccurrenceController extends Controller
{
    public function edit(int $id)
    {
        $occurrence = Occurrence::find($id)
            ->load(['transitions' => function ($query) {
                $query->where('transitions.isactive', true)
                    ->with('user');
            }]);
        $occurrenceResource = OccurrenceEditResource::make($occurrence);
        return response()->json([
            'occurrence' => $occurrenceResource
        ]);
    }

    public function toAssume(Request $request, int $id)
    {
        $occurrence = Occurrence::find($id);

        try {
            \DB::beginTransaction();

            Transition::where('occurrence_id', $occurrence->id)
                ->update(['isactive' => false, 'close_date' => now()]);

            $lastTransition = Transition::where('occurrence_id', $occurrence->id)->latest()->first();

            Transition::create([
                'occurrence_id' => $lastTransition->occurrence_id,
                'step_id'      => $lastTransition->step_id,
                'wasapproved'  => $lastTransition->wasapproved,
                'doc_due_date' => $lastTransition->doc_due_date,
                'isactive'     => 1,
                'user_id'      => auth()->user()->id,
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
}
