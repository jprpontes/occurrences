<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Sector;
use App\Http\Requests\ActivityStore;
use App\Http\Requests\ActivityUpdate;

class ActivityController extends Controller
{
    public function getActivities()
    {
        $limit = 15;
        $activities = Activity::orderBy('id', 'desc')
            ->offset(request()->offset ?? 0)
            ->limit($limit)
            ->where('sector_id', request()->sectorId)
            ->select(['id', 'name', 'sector_id', 'created_at']);

        if (request()->search) {
            $activities = $activities->where(function ($query) {
                $query->whereRaw("LOWER(name) like '%".strtolower(request()->search)."%'");
            });
        }

        $activities = $activities->get();

        return response()->json([
            'verMais' => count($activities) === $limit ? 1 : 0,
            'activities' => $activities
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
        $activity = Activity::select(['id', 'name', 'sector_id'])->whereId($id)->first();

        $sectors = Sector::orderBy('name')
            ->select(['id', 'name'])
            ->get();

        return response()->json([
            'activity' => $activity,
            'sectors'  => $sectors
        ]);
    }

    public function store(ActivityStore $request)
    {
        $data = $request->all();
        Activity::create($data);
    }

    public function update(int $id, ActivityUpdate $request)
    {
        $data = $request->all();
        Activity::find($id)->update($data);
    }
}
