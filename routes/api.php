<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::resource('agenda', \App\Http\Controllers\Api\AgendaController::class);
