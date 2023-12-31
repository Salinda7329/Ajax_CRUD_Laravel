<?php

use App\Http\Controllers\Student;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});
//route to store student data
Route::post('/store',[StudentController::class,'store'])->name('store');

//route to fetch student data
Route::get('/fetchall',[StudentController::class,'fetchAllData'])->name('fetchAll');

//route to edit student data
Route::get('/edit',[StudentController::class,'edit'])->name('edit');

//route to update student data
Route::post('/update',[StudentController::class,'update'])->name('update');

//route to delete student data
Route::delete('/delete',[StudentController::class,'delete'])->name('delete');

