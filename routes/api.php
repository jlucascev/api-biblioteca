<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BookController;
use App\Http\Controllers\CopyController;
use App\Http\Controllers\CategoryController;

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

Route::prefix('books')->group(function () {

	Route::post('/create',[BookController::class, 'createBook']);
	Route::post('/update/{isbn}',[BookController::class, 'updateBook']);
	Route::post('/delete/{isbn}',[BookController::class, 'deleteBook']);
	Route::post('/add/category',[BookController::class, 'addCategory']);
	Route::get('/',[BookController::class, 'listBooks']);
	Route::get('/details/{id}',[BookController::class, 'viewBook']);
	Route::get('/copies/{isbn}',[BookController::class, 'viewCopies']);

});

Route::prefix('copies')->group(function () {

	Route::post('/create',[CopyController::class, 'createCopy']);
	Route::post('/update/{id}',[CopyController::class, 'updateCopy']);
	Route::post('/delete/{id}',[CopyController::class, 'deleteCopy']);
	Route::get('/details/{id}',[CopyController::class, 'viewCopy']);

});

Route::prefix('categories')->group(function () {

	Route::post('/create',[CategoryController::class, 'createCategory']);
	Route::post('/delete/{id}',[CategoryController::class, 'deleteCategory']);

});
