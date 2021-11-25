<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    $students = \App\Models\StudentTest::all();
    return view('score', ['studentTests' => $students]);
});

Route::get('/login', function() {
    return response('You are not logged in, try to use the /api/login route ;) or /api/register', 401);
})->name('login');
