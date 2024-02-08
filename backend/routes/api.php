<?php

use App\Http\Controllers\ConversationController;
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

Route::get('users/{user}/conversations', [ConversationController::class, 'list']);
Route::get('users/{user}/conversations/{conversation}', [ConversationController::class, 'get']);
Route::post('users/{user}/conversations/{conversation}/messages', [ConversationController::class, 'addMessage']);
