<?php
use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

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
Route::get("/todolist",[App\Http\Controllers\TodoController::class,"index"])->name("todolist");
Route::get("/todo/create",[App\Http\Controllers\TodoController::class,"create"])->name("todo/create");
Route::post("/todo/store",[App\Http\Controllers\TodoController::class,"store"])->name("todo/store");
Route::get("/{todo:slug}/edit",[App\Http\Controllers\TodoController::class,"edit"])->name("todo/edit");
Route::get("/{todo:slug}/show",[App\Http\Controllers\TodoController::class,"show"])->name("todo/show");
Route::patch("/{todo}/complete",[App\Http\Controllers\TodoController::class,"complete"])->name("todo/complete");
Route::patch("/todo/{slug}/update",[App\Http\Controllers\TodoController::class,"update"])->name("todo/update");
Route::delete("/todo/{slug}/delete",[App\Http\Controllers\TodoController::class,"destroy"])->name("todo/delete");

Route::get('/', function () {
    return view('welcome');
});
Route::post('/p',[App\Http\Controllers\UserController::class,'profile']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
