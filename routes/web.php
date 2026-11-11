<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AssetMutationController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Asset;

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
});
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/home', function () {
        $assets = Asset::with(['category', 'location'])->latest()->get();
        return view('home', compact('assets'));
    })->name('home');
});
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('categories', CategoryController::class)->except(['create', 'edit', 'show']);
    Route::resource('locations', LocationController::class)->except(['create', 'edit', 'show']);
    Route::resource('assets', AssetController::class);

    Route::get('/mutations', [AssetMutationController::class, 'index'])->name('mutations.index');
    Route::get('/mutations/create', [AssetMutationController::class, 'create'])->name('mutations.create');
    Route::post('/mutations', [AssetMutationController::class, 'store'])->name('mutations.store');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/print', [ReportController::class, 'print'])->name('reports.print');
});

require __DIR__.'/auth.php';