<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssetReportController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role === 'admin') {
            $reports = AssetReport::with(['asset', 'user'])->latest()->get();
        } else {
            $reports = AssetReport::with(['asset', 'user'])
                        ->where('user_id', $user->id)
                        ->latest()
                        ->get();
        }

        return view('reports_ticket.index', compact('reports'));
    }

    public function create()
    {
        $assets = Asset::all();
        return view('reports_ticket.create', compact('assets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'asset_id'          => 'required|exists:assets,id',
            'issue_description' => 'required|string',
        ]);

        AssetReport::create([
            'asset_id'          => $request->asset_id,
            'user_id'           => Auth::id(),
            'issue_description' => $request->issue_description,
            'status'            => 'Pending',
        ]);

        return redirect()->route('tickets.index')->with('success', 'Laporan kerusakan berhasil dikirim!');
    }

    public function updateStatus(Request $request, AssetReport $ticket)
    {
        $request->validate([
            'status' => 'required|in:Pending,Sedang Diperbaiki,Selesai',
        ]);

        $ticket->update([
            'status' => $request->status,
        ]);

        if ($request->status === 'Selesai') {
            $ticket->asset->update(['condition' => 'Baik']);
        } elseif ($request->status === 'Sedang Diperbaiki') {
            $ticket->asset->update(['condition' => 'Rusak Ringan']);
        }

        return redirect()->route('tickets.index')->with('success', 'Status laporan berhasil diperbarui!');
    }
}