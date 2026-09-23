<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ListingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
})->name('home');


/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/profile',
        [ProfileController::class, 'edit']
    )->name('profile.edit');

    Route::patch(
        '/profile',
        [ProfileController::class, 'update']
    )->name('profile.update');

    Route::delete(
        '/profile',
        [ProfileController::class, 'destroy']
    )->name('profile.destroy');


    /*
    |--------------------------------------------------------------------------
    | Listing CRUD
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/listings/create',
        [ListingController::class, 'create']
    )->name('listings.create');

    Route::post(
        '/listings',
        [ListingController::class, 'store']
    )->name('listings.store');

    Route::get(
        '/my-listings',
        [ListingController::class, 'myListings']
    )->name('listings.mine');

    Route::get(
        '/listings/{listing}/edit',
        [ListingController::class, 'edit']
    )->name('listings.edit');

    Route::put(
        '/listings/{listing}',
        [ListingController::class, 'update']
    )->name('listings.update');

    Route::delete(
        '/listings/{listing}',
        [ListingController::class, 'destroy']
    )->name('listings.destroy');


    /*
    |--------------------------------------------------------------------------
    | Dependent Dropdown APIs
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/api/categories/{category}/subcategories',
        [ListingController::class, 'subcategories']
    )->name('api.categories.subcategories');

    Route::get(
        '/api/countries/{country}/states',
        [ListingController::class, 'states']
    )->name('api.countries.states');

    Route::get(
        '/api/states/{state}/cities',
        [ListingController::class, 'cities']
    )->name('api.states.cities');

    Route::get(
        '/api/cities/{city}/areas',
        [ListingController::class, 'areas']
    )->name('api.cities.areas');
});


/*
|--------------------------------------------------------------------------
| Public Listing Detail
|--------------------------------------------------------------------------
*/

Route::get(
    '/listings/{listing}',
    [ListingController::class, 'show']
)->name('listings.show');


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';
