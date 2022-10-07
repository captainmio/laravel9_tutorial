<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

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

// Route::get('/hello', function () {
//     return response("<h1>Hello World</h1>", 200)->header('Content-Type', 'text/plain');
// });

// Route::get('/post/{id}', function($id) {
//     // dd($id);
//     // ddd($id);
//     return response("Post: ". $id);
// })
// ->where('id', '[0-9]+'); // add a conditional where clause wherein it will only accept value of "id" as integer

// Route::get('/search', function (Request $request) {
//     dd($request->all());
// });






// All listings
Route::get('/', [ListingController::class, 'index']);

// Show Create Form
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

// Store a listing
Route::post('/listings/store', [ListingController::class, 'store'])->middleware('auth');

// Manage listings
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');

// Show edit Form
Route::get('/listings/{id}/edit', [ListingController::class, 'edit'])->middleware('auth');

// Update a listing
Route::put('/listings/{id}', [ListingController::class, 'update'])->middleware('auth');

// Update a listing
Route::delete('/listings/{id}', [ListingController::class, 'destroy'])->middleware('auth');

// Show a listing
Route::get('/listings/{id}', [ListingController::class, 'show']);


// Show registration Form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// Logout user
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Create user
Route::post('/users', [UserController::class, 'store']);

// Show Login form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// Show Login form
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

