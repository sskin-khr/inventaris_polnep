<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetMutation;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssetMutationController extends Controller
{
    public function index()
    {
        $mutations = AssetMutation::with(['asset', 'fromLocation', 'toLocation', 'user'])->latest()->get();
        return view('mutations.index', compact('mutations'));
    }

    public function create()
    {
        $assets = Asset::with('location')->get();
        $locations = Location::all();
        return view('mutations.create', compact('assets', 'locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'asset_id'       => 'required|exists:assets,id',
            'to_location_id' => 'required|exists:locations,id',
            'mutation_date'  => 'required|date',
            'notes'          => 'nullable|string',
        ]);

        $asset = Asset::findOrFail($request->asset_id);

        if ($asset->location_id == $request->to_location_id) {
            return back()->withErrors(['to_location_id' => 'Lokasi tujuan tidak boleh sama dengan lokasi saat ini!']);
        }

        AssetMutation::create([
            'asset_id'         => $asset->id,
            'from_location_id' => $asset->location_id,
            'to_location_id'   => $request->to_location_id,
            'user_id'          => Auth::id(),
            'mutation_date'    => $request->mutation_date,
            'notes'            => $request->notes,
        ]);

        $asset->update([
            'location_id' => $request->to_location_id,
        ]);

        return redirect()->route('mutations.index')->with('success', 'Mutasi aset berhasil dicatat!');
    }
}