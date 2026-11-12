<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AssetController extends Controller
{
    public function index()
    {
        $assets = Asset::with(['category', 'location'])->latest()->get();
        return view('assets.index', compact('assets'));
    }

    public function create()
    {
        $categories = Category::all();
        $locations = Location::all();
        return view('assets.create', compact('categories', 'locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'asset_code'    => 'required|unique:assets,asset_code|max:50',
            'name'          => 'required|string|max:255',
            'category_id'   => 'required|exists:categories,id',
            'location_id'   => 'required|exists:locations,id',
            'condition'     => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'purchase_date' => 'nullable|date',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('assets', 'public');
        }

        Asset::create($data);

        return redirect()->route('assets.index')->with('success', 'Aset baru berhasil ditambahkan!');
    }

    public function edit(Asset $asset)
    {
        $categories = Category::all();
        $locations = Location::all();
        return view('assets.edit', compact('asset', 'categories', 'locations'));
    }

    public function update(Request $request, Asset $asset)
    {
        $request->validate([
            'asset_code'    => 'required|max:50|unique:assets,asset_code,' . $asset->id,
            'name'          => 'required|string|max:255',
            'category_id'   => 'required|exists:categories,id',
            'location_id'   => 'required|exists:locations,id',
            'condition'     => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'purchase_date' => 'nullable|date',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($asset->image) {
                Storage::disk('public')->delete($asset->image);
            }
            $data['image'] = $request->file('image')->store('assets', 'public');
        }

        $asset->update($data);

        return redirect()->route('assets.index')->with('success', 'Data aset berhasil diperbarui!');
    }

    public function destroy(Asset $asset)
    {
        if ($asset->image) {
            Storage::disk('public')->delete($asset->image);
        }

        $asset->delete();
        return redirect()->route('assets.index')->with('success', 'Data aset berhasil dihapus!');
    }
}