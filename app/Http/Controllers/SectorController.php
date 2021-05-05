<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sector;
use App\Http\Requests\SectorStore;
use App\Http\Requests\SectorUpdate;

class SectorController extends Controller
{
    public function index()
    {
        return view('sectors');
    }

    public function getSectors()
    {
        $limit = 15;
        $sectors = Sector::orderBy('id', 'desc')
            ->offset(request()->offset ?? 0)
            ->limit($limit)
            ->select(['id', 'name', 'document_type', 'created_at']);

        if (request()->search) {
            $sectors = $sectors->where(function ($query) {
                $query->whereRaw("LOWER(name) like '%".strtolower(request()->search)."%'");
            });
        }

        $sectors = $sectors->get();

        return response()->json([
            'verMais' => count($sectors) === $limit ? 1 : 0,
            'sectors' => $sectors
        ]);
    }

    public function create()
    {
        return response()->json([
            'documentTypeList' => Sector::DOCUMENT_TYPE_LIST
        ]);
    }

    public function edit(int $id)
    {
        $sector = Sector::select(['id', 'name', 'document_type'])->whereId($id)->first();

        return response()->json([
            'sector'  => $sector,
            'documentTypeList' => Sector::DOCUMENT_TYPE_LIST
        ]);
    }

    public function store(SectorStore $request)
    {
        $data = $request->all();
        Sector::create($data);
    }

    public function update(int $id, SectorUpdate $request)
    {
        $data = $request->all();
        Sector::find($id)->update($data);
    }
}
