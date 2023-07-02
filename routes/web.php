<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactsController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/////CONTACT
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/insert', [ContactsController::class, 'updateOrStore'])->name('updateOrStore');
Route::post('/delete', [ContactsController::class, 'delete'])->name('delete');
Route::get('/contactList', [ContactsController::class, 'getContacts'])->name('list');

/////Options
Route::get('contactOptions', [HomeController::class, 'contactOptions'])->name('contactOp');
