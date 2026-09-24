<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [ListingController::class, 'index'])
    ->name('home');

Route::get('/listings', [ListingController::class, 'index'])
    ->name('listings.index');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', function () {
        return redirect()->route('listings.mine');
    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Create Listing
    |--------------------------------------------------------------------------
    */

    Route::get('/listings/create', [ListingController::class, 'create'])
        ->name('listings.create');

    Route::post('/listings', [ListingController::class, 'store'])
        ->name('listings.store');

    /*
    |--------------------------------------------------------------------------
    | My Listings
    |--------------------------------------------------------------------------
    */

    Route::get('/my-listings', [ListingController::class, 'myListings'])
        ->name('listings.mine');

    /*
    |--------------------------------------------------------------------------
    | Edit Listing
    |--------------------------------------------------------------------------
    */

    Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])
        ->name('listings.edit');

    Route::put('/listings/{listing}', [ListingController::class, 'update'])
        ->name('listings.update');

    Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])
        ->name('listings.destroy');
});

/*
|--------------------------------------------------------------------------
| Public Listing Detail
|--------------------------------------------------------------------------
*/

Route::get('/listings/{listing}', [ListingController::class, 'show'])
    ->name('listings.show');

/*
|--------------------------------------------------------------------------
| Category / Location Pages
|--------------------------------------------------------------------------
*/

Route::get(
    '/category/{category:slug}',
    [ListingController::class, 'category']
)->name('listings.category');

Route::get(
    '/city/{city:slug}',
    [ListingController::class, 'city']
)->name('listings.city');

Route::get(
    '/city/{city:slug}/category/{category:slug}',
    [ListingController::class, 'cityCategory']
)->name('listings.city.category');

/*
|--------------------------------------------------------------------------
| Settings
|--------------------------------------------------------------------------
*/

require __DIR__ . '/settings.php';
