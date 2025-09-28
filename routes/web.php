<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\TaskController;

// Normal web route for Blade view
Route::get('/', function () {
    return view('welcome');
});

//Route for view task page
Route::view('/tasks-form', 'tasks'); 
