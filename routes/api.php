<?php

use App\Http\Controllers\API\PropertyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('real-estate')->group(function() {
	Route::get('/', [PropertyController::class, 'index'])->name('property-list');
	Route::get('view/{id}', [PropertyController::class, 'view'])->name('property-view');
	Route::post('add', [PropertyController::class, 'add'])->name('property-add');
	Route::post('edit', [PropertyController::class, 'edit'])->name('property-edit');
	Route::post('delete', [PropertyController::class, 'delete'])->name('property-delete');
});