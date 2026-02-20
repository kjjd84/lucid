<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

// Route::get('/', function () {
//     return view('welcome');
// });

if (
    app()->isLocal() &&
    Schema::hasTable('users') &&
    Auth::guest() &&
    $user = User::find(1)
) {
    Auth::login($user);
}
