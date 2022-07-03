<?php
use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/person', function (Request $request) {
    return $request->person();
});

//API route for register new user
Route::post('/register', [AuthController::class, 'register'])->name('register');
//API route for login user
Route::post('/login', [AuthController::class, 'login'])->name('login');

//Protecting Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    // Route::get('/profile', function (Request $request) {
    //     return auth()->user();
    // });

    Route::resource('person', App\Http\Controllers\API\PersonController::class);
    Route::resource('pages', App\Http\Controllers\API\PageController::class);
    Route::resource('posts', App\Http\Controllers\API\PostController::class);

    // API route for logout person
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
