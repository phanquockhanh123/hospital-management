<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BedController;
use App\Http\Controllers\BedTypeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);

Route::get('/home', [HomeController::class, 'redirect']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

//-----------------------------------Bed Types ----------------------------------------------------------------

Route::get('/bed_types', [BedTypeController::class, 'index'])->name('bed_types.index');
Route::get('/bed_types/create', [BedTypeController::class, 'create'])->name('bed_types.create');
Route::post('/bed_types', [BedTypeController::class, 'store'])->name('bed_types.store');
Route::get('/bed_types/{bed_type}', [BedTypeController::class, 'show'])->name('bed_types.show');
Route::get('/bed_types/{bed_type}/edit', [BedTypeController::class, 'edit'])->name('bed_types.edit');
Route::put('/bed_types/{bed_type}', [BedTypeController::class, 'update'])->name('bed_types.update');
Route::delete('/bed_types/{bed_type}', [BedTypeController::class, 'destroy'])->name('bed_types.destroy');

//-----------------------------------Beds ----------------------------------------------------------------
Route::get('/beds', [BedController::class, 'index'])->name('beds.index');
Route::get('/beds/create', [BedController::class, 'create'])->name('beds.create');
Route::post('/beds', [BedController::class, 'store'])->name('beds.store');
Route::get('/beds/{bed}', [BedController::class, 'show'])->name('beds.show');
Route::get('/beds/{bed}/edit', [BedController::class, 'edit'])->name('beds.edit');
Route::put('/beds/{bed}', [BedController::class, 'update'])->name('beds.update');
Route::delete('/beds/{bed}', [BedController::class, 'destroy'])->name('beds.destroy');







