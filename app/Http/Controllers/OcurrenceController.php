<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ocurrence;
use App\Http\Resources\OcurrenceEditResource;

class OcurrenceController extends Controller
{
    public function edit(int $id)
    {
        $ocurrence = Ocurrence::find($id)
            ->load(['transitions' => function ($query) {
                $query->where('transitions.isactive', true)
                    ->with('user');
            }]);
        $ocurrenceResource = OcurrenceEditResource::make($ocurrence);
        return response()->json([
            'ocurrence' => $ocurrenceResource
        ]);
    }

    public function toAssume(Request $request, int $ocurrenceId)
    {

    }
}
