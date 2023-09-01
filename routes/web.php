<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ContentController;
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

Route::get('/', [PageController::class, 'index']);

Route::get('/get_content', [ContentController::class, 'get_content']);
Route::post('/get_bscscanapi', [ContentController::class, 'get_bscscanapi']);
Route::post('/upd_content', [ContentController::class, 'update_content']);
