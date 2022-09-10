<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\JWTController;
use App\Http\Controllers\FileUploaderController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



// *Login* //
Route::post('/login', [JWTController::class, 'login'])->name('api.authenticate');

// *Operations* //
Route::group(['middleware' => ['jwt.verify']], function() {
    Route::post('/upload-pdf', [FileUploaderController::class, 'uploadPdf'])->name('api.upload.pdf');;
    Route::get('/user-pdf-list', [FileUploaderController::class, 'pdfList']);
});
    



