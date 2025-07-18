<?php

use Illuminate\Support\Facades\Route;

// Route::get('/admin', function(){
//     return 'Hola desde el administrador';
// })->name('admin.dashboard');

Route::get('/', function () {
    return view('admin.dashboard');
})->name('dashboard');