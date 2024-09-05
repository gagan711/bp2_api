<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlvckboxController;
use App\Http\Controllers\BlvckcardsController;
use App\Http\Controllers\ContentcardsController as ControllersContentcardsController;
use App\Http\Controllers\dashboard\AuthConteroller;
use App\Http\Controllers\dashboard\BlvckboxController as DashboardBlvckboxController;
use App\Http\Controllers\dashboard\BlvckcardsController as DashboardBlvckcardsController;
use App\Http\Controllers\dashboard\ConclusionController;
use App\Http\Controllers\dashboard\ContentcardsController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\dashboard\SubscriptionsController;
use App\Http\Controllers\dashboard\UserManagementController;
use App\Http\Controllers\dashboard\EditorialController;
use App\Http\Controllers\LogAccessController;
use App\Http\Controllers\SubscriptionsController as ControllersSubscriptionsController;
use App\Models\Contentcard;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth.api')->group(function () {
    Route::get('/track', [LogAccessController::class, 'logAccess']);
    Route::get('/track/stats', [LogAccessController::class, 'index']);
    Route::get('/track/revenue-stats', [LogAccessController::class, 'revenueStats']);
});

// Website
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/activate-account/{token}', [AuthController::class, 'activateAccount']);
Route::get('/send-test-email', [AuthController::class, 'sendTestEmail']);
Route::post('forgot-password', [AuthController::class, 'sendResetLinkEmail']);
Route::post('/validate-reset-token', [AuthController::class, 'validateResetToken']);
Route::post('/change-password', [AuthController::class, 'changePassword']);

Route::middleware('auth.api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/getuserdata', [AuthController::class, 'getUserData']);
    Route::get('/user', [AuthController::class, 'updateProfile']);
    Route::put('/user', [AuthController::class, 'updateProfile']);
    Route::get('/user/role', [AuthController::class, 'getUserRole']);
    Route::post('/update-package', [AuthController::class, 'updatePackage']);
});

Route::middleware('auth.api')->group(function () {
    // Route::get('/blvckbox', [BlvckboxController::class, 'index']);
    // Route::get('/blvckbox/{box}', [BlvckcardsController::class, 'index']);
});

Route::get('/blvckboxes', [BlvckboxController::class, 'index']);
Route::post('/blvckboxes', [BlvckboxController::class, 'store']);
Route::get('/contentcards/{slug}', [ControllersContentcardsController::class, 'index']);
Route::get('/blvckcards/{slug}', [BlvckcardsController::class, 'index']);
Route::get('blvckcards/show/{slug}', [BlvckcardsController::class, 'show']);
Route::put('/blvckboxes/{id}', [BlvckboxController::class, 'update']);
Route::delete('/blvckboxes/{id}', [BlvckboxController::class, 'destroy']);
Route::get('/packages', [ControllersSubscriptionsController::class, 'index']);


Route::middleware('auth.api')->group(function () {
    Route::post('dashboard/createModerator', [AuthConteroller::class, 'createModerator']);
    Route::get('/dashboard/users', [UserManagementController::class, 'index']);
    Route::put('/dashboard/users/{id}', [UserManagementController::class, 'update']);
    Route::delete('/dashboard/users/{id}', [UserManagementController::class, 'destroy']);

    Route::get('dashboard/packages', [SubscriptionsController::class, 'index']);
    Route::post('dashboard/packages', [SubscriptionsController::class, 'store']);
    Route::get('dashboard/packages/{id}', [SubscriptionsController::class, 'show']);
    Route::put('dashboard/packages/{id}', [SubscriptionsController::class, 'update']);
    Route::delete('dashboard/packages/{id}', [SubscriptionsController::class, 'destroy']);

    Route::get('/dashboard/blvckboxes', [DashboardBlvckboxController::class, 'index'])->name('blvckboxes.index');
    Route::post('/dashboard/blvckboxes', [DashboardBlvckboxController::class, 'store'])->name('blvckboxes.store');
    Route::get('/dashboard/blvckboxes/{id}', [DashboardBlvckboxController::class, 'show'])->name('blvckboxes.show');
    Route::post('/dashboard/blvckboxes/{id}', [DashboardBlvckboxController::class, 'update'])->name('blvckboxes.update');
    Route::delete('/dashboard/blvckboxes/{id}', [DashboardBlvckboxController::class, 'destroy'])->name('blvckboxes.destroy');

    Route::get('/dashboard/blvckcards', [DashboardBlvckcardsController::class, 'index'])->name('blvckcards.index');
    Route::post('/dashboard/blvckcards', [DashboardBlvckcardsController::class, 'store'])->name('blvckcards.store');
    Route::get('/dashboard/blvckcards/{id}', [DashboardBlvckcardsController::class, 'show'])->name('blvckcards.show');
    Route::post('/dashboard/blvckcards/{id}', [DashboardBlvckcardsController::class, 'update'])->name('blvckcards.update');
    Route::delete('/dashboard/blvckcards/{id}', [DashboardBlvckcardsController::class, 'destroy'])->name('blvckcards.destroy');
    Route::delete('/dashboard/blvckcards/images/{id}', [DashboardBlvckcardsController::class, 'deleteImage']);

    Route::get('/dashboard/contentcards', [ContentcardsController::class, 'index']);
    Route::get('/dashboard/contentcards/{id}', [ContentcardsController::class, 'show']);
    Route::post('/dashboard/contentcards', [ContentcardsController::class, 'store']);
    Route::post('/dashboard/contentcards/{id}', [ContentcardsController::class, 'update']);
    Route::delete('/dashboard/contentcards/{id}', [ContentcardsController::class, 'destroy']);

    Route::get('/dashboard/stats', [DashboardController::class, 'getStats']);

    Route::get('/dashboard/blvckbox/{slug}/editorial', [EditorialController::class, 'getEditorial']);
    Route::post('/dashboard/blvckbox/{slug}/editorial', [EditorialController::class, 'storeOrUpdate']);

    Route::get('/dashboard/blvckbox/{slug}/conclusion', [ConclusionController::class, 'getEditorial']);
    Route::post('/dashboard/blvckbox/{slug}/conclusion', [ConclusionController::class, 'storeOrUpdate']);
});


