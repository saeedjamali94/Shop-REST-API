<?php

use \Illuminate\Support\Facades\Route;

Route::apiResource("users", \App\Http\Controllers\Admin\UserController::class);
