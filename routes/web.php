<?php

use App\Models\Listing;
use Illuminate\Http\Request;
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

// Common Resource Routes:
// index - Show all listings
// show - Show single listing
// create - Show form to create new listing
// store - Store new listing
// edit - Show form to edit listing
// update - Update listing
// destroy - Delete listing  



Route::get("/", [ListingController::class, 'index']);

Route::get("/listings/create", [ListingController::class,"create"])->middleware('auth');

//Store listing data 
Route::post("/listings", [ListingController::class,"store"]);

//Show edit form 
Route::get("/listings/{listing}/edit", [ListingController::class,"edit"]);

// Update listings 
Route::put("/listings/{listing}", [ListingController::class,"update"])->name("listing->update");

Route::delete("/listing/{listing}", [ListingController::class,"destroy"])->name('listing->destroy');

//Single Listing
Route::get("/listings/{listing}", [ListingController::class,"show"]);

//Show user form

Route::get("/register", [UserController::class, 'create']);

//Create new user 
Route::post("/users", [UserController::class, 'store']);

//Log user out 
Route::post('/logout', [UserController::class,'logout']);

//Show login form  
Route::get('/login', [UserController::class,'login']);


//Log the user in
Route::post('/users/authenticate', [UserController::class,'authenticate']);


