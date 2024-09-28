<?php

use App\Helper\JWTToken;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\RentalController;
use App\Http\Controllers\Frontend\CarController as FrontendCarController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\RentalController as FrontendRentalController;
use Illuminate\Support\Facades\Route;


/*
//////////////////////////////////////////////////////////
///////////////------ Admin Routes  ------///////////////
//////////////////////////////////////////////////////////
*/


Route::middleware('verify_auth', 'isAdmin')->group(function () {

    // Admin Panel Api Routes
    // Customer Routes
    Route::post('/profile-details', [CustomerController::class, 'profileDetails']);
    Route::post('/profile-update', [CustomerController::class, 'ProfileUpdate']);
    Route::post('/customer-update-admin', [CustomerController::class, 'customerDetailsUpdate']);
    Route::post('/customer-list', [CustomerController::class, 'customerList']);
    Route::post('/customer-delete', [CustomerController::class, 'deleteCustomer']);
    Route::post('/customer-by-id', [CustomerController::class, 'customerDetailsById']);

    // Car Routes
    Route::post('/car-create', [CarController::class, 'carCreate']);
    Route::post('/car-list', [CarController::class, 'carList']); 
    Route::post('/car-update', [CarController::class, 'carUpdate']);
    Route::post('/car-delete', [CarController::class, 'carDelete']);
    Route::post('/car-by-id', [CarController::class, 'carDetailsById']);

    // Rental Routes
    Route::post('/rental-list', [RentalController::class, 'rentalList']);
    Route::post('/rental-status-update', [RentalController::class, 'rentalStatusUpdate']);
    Route::post('/rental-delete', [RentalController::class, 'rentalDelete']);
    Route::post('/rental-history-by-id', [RentalController::class, 'rentalHistoryById']);

    // Dashboard Summary
    Route::post('/dashboard-summary', [CustomerController::class, 'dashboardSummary']);

    //Admin Panel Page Routes
    Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [CustomerController::class, 'profile'])->name('profile');
    Route::get('/admin/customers', [CustomerController::class, 'index'])->name('customers');
    Route::get('/admin/cars', [CarController::class, 'index'])->name('cars');
    Route::get('/admin/rentals', [RentalController::class, 'rentalHistory'])->name('rentals');

});


/*
//////////////////////////////////////////////////////////
/////////////------ Frontend Routes ------///////////////
//////////////////////////////////////////////////////////
*/

// Frontend Home Page Routes
Route::get('/', [PageController::class, 'home']);
Route::get('/about', [PageController::class, 'about']);
Route::get('/company', [PageController::class, 'company']);
Route::get('/services', [PageController::class, 'services']);
Route::get('/testimonials', [PageController::class, 'testimonials']);
Route::get('/contact', [PageController::class, 'contact']);

// Frontend Login, Signup and Logout Api Routes
Route::post('/signup', [CustomerController::class, 'signup']);
Route::post('/login', [CustomerController::class, 'login']);
Route::get('/logout', [CustomerController::class, 'logout']);

// Frontend Page and ApiRoutes
// For Cars
Route::get('/cars', [PageController::class, 'cars'])->name('cars');
Route::get('/car-list', [FrontendCarController::class, 'carList']);
Route::get('/car/{id}', [FrontendCarController::class, 'carDetails']);
Route::post('/car-filter', [FrontendCarController::class, 'carFilter']);


Route::middleware('verify_auth')->group(function () {
    // For Rental page and ApiRoutes
    Route::post('/rent-car', [FrontendRentalController::class, 'rentCar']);
    Route::post('/rental-history', [FrontendRentalController::class, 'rentalHistory']);
    Route::post('/rental-cancel', [FrontendRentalController::class, 'rentalCancel']);
    Route::get('/rental-history', [PageController::class, 'rental']);

    // For Profile page 
    Route::get('/customer-profile', [PageController::class, 'profile']);
    Route::post('/customer-details', [CustomerController::class, 'profileDetails']);
    Route::post('/customer-profile-update', [CustomerController::class, 'ProfileUpdate']);

});
