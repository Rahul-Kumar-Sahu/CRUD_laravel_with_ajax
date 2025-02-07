<?php

use App\Http\Controllers\pageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\empController;

// Route::get('/', function () {
//     return view('employee.index');
// });
Route::get('/', [empController::class, 'index'])->name('index');
Route::get('/employee/index', [empController::class, 'index'])->name('emp.index');
Route::get('/employee/add', [empController::class, 'add'])->name('loadView.emp.add');
Route::get('/employee/update/{id?}', [empController::class, 'add'])->name('loadView.emp.update');
Route::post('/employee/add', [empController::class, 'store'])->name('emp.data.store');
Route::get('/employee/{id}', [empController::class, 'delete'])->name('emp.data.delete');
Route::get('/get-employees', [empController::class, 'getEmps'])->name('fetch_emps');
Route::get('/employee/{id}/update', [empController::class, 'updateFetch'])->name('update_emps');
// Route::get('/employee/update', [empController::class, 'updateDetails'])->name('update_emp_details');