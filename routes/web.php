<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\AssetMutationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AssetReportController;
use App\Http\Controllers\ProfileController;
use App\Models\Asset; 
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        return Auth::user()->role === 'admin' 
            ? redirect()->route('dashboard') 
            : redirect()->route('home');
    }
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/home', function () {
        $assets = Asset::with(['category', 'location'])->latest()->get();
        return view('home', compact('assets'));
    })->name('home');

    Route::get('/assets', [AssetController::class, 'index'])->name('assets.index');
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/locations', [LocationController::class, 'index'])->name('locations.index');
    Route::get('/mutations', [AssetMutationController::class, 'index'])->name('mutations.index');
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/print', [ReportController::class, 'print'])->name('reports.print');
    
    Route::get('/tickets', [AssetReportController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/create', [AssetReportController::class, 'create'])->name('tickets.create');
    Route::post('/tickets', [AssetReportController::class, 'store'])->name('tickets.store');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/assets/create', [AssetController::class, 'create'])->name('assets.create');
    Route::post('/assets', [AssetController::class, 'store'])->name('assets.store');
    Route::get('/assets/{asset}/edit', [AssetController::class, 'edit'])->name('assets.edit');
    Route::put('/assets/{asset}', [AssetController::class, 'update'])->name('assets.update');
    Route::delete('/assets/{asset}', [AssetController::class, 'destroy'])->name('assets.destroy');

    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::post('/locations', [LocationController::class, 'store'])->name('locations.store');
    Route::delete('/locations/{location}', [LocationController::class, 'destroy'])->name('locations.destroy');

    Route::get('/mutations/create', [AssetMutationController::class, 'create'])->name('mutations.create');
    Route::post('/mutations', [AssetMutationController::class, 'store'])->name('mutations.store');

    Route::patch('/tickets/{ticket}/status', [AssetReportController::class, 'updateStatus'])->name('tickets.updateStatus');
});

require __DIR__.'/auth.php';