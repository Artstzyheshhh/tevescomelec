<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CandidateController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){
    //candidates
    Route::get('/get-candidates', [CandidateController::class, 'getCandidates']);
    Route::post('/add-Candidate', [CandidateController::class, 'addCandidate']);
    Route::put('/edit-Candidate/{id}', [CandidateController::class, 'editCandidate']);
    Route::delete('/delete-Candidate/{id}', [CandidateController::class, 'deleteCandidate']);
    //logout
    Route::post('/logout', [AuthenticationController::class, 'logout']);

});
