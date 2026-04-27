<?php

use App\Http\Controllers\Auth\ANPIAuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Routes SSO ANPI-Gabon
|--------------------------------------------------------------------------
| Publiez ce fichier avec :
|   php artisan vendor:publish --tag=anpi-sso-routes
| Puis incluez-le dans routes/web.php :
|   require base_path('routes/anpi.php');
*/

Route::get('/auth/anpi', [ANPIAuthController::class, 'redirect'])
    ->name('auth.anpi');

Route::get('/auth/anpi/callback', [ANPIAuthController::class, 'callback'])
    ->name('auth.anpi.callback');

Route::post('/auth/logout', [ANPIAuthController::class, 'logout'])
    ->name('auth.logout')
    ->middleware('auth');

Route::get('/logout', [ANPIAuthController::class, 'logout'])
    ->middleware('auth');
