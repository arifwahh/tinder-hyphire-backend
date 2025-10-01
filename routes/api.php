<?php
// routes/api.php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PersonController;

Route::get('/people', [PersonController::class, 'index']); // list recommended people
Route::post('/people/{id}/like', [PersonController::class, 'like']);
Route::post('/people/{id}/dislike', [PersonController::class, 'dislike']);
Route::get('/people/liked/list', [PersonController::class, 'likedPeople']);