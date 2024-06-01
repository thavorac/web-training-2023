<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;

Route::get('/', function () {
    return view('welcome');
});

// Create photo
Route::get('/form-upload', function () {
    return view('upload_file');
});
Route::post('/upload', [FileController::class, 'upload']);

// Edit photo
Route::get('/form-upload/{photoId}', [FileController::class, 'edit']);
Route::post('/update_upload/{photoId}', [FileController::class, 'update_upload']);

// List all photo
Route::get('/list-photos', [FileController::class, 'list']);
