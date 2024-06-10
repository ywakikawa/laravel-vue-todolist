<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::apiResource('/todo', TodoController::class);

Route::put('/todo/{id}/completed', [TodoController::class, 'completed']);

