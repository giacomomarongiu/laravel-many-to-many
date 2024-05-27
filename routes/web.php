<?php

use App\Http\Controllers\Admin\DashboardController;

use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Guests\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\TechnologyController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [PageController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified'])
    // For chain
    ->name('admin.')
    // Prefix for views
    ->prefix('admin')
    ->group(function () {
        // Default route changed
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        // Route for my projects
        Route::resource('projects', ProjectController::class);
        Route::resource('types', TypeController::class);
        Route::resource('technologies', TechnologyController::class);


    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__ . '/auth.php';
