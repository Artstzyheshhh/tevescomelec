<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\PartylistController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\PositionController;

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
    Route::get('/get-Candidates', [CandidateController::class, 'getCandidates']);
    Route::post('/add-Candidate', [CandidateController::class, 'addCandidate']);
    Route::put('/edit-Candidate/{id}', [CandidateController::class, 'editCandidate']);
    Route::delete('/delete-Candidate/{id}', [CandidateController::class, 'deleteCandidate']);
    //partylists
    Route::get('/get-Partylists', [PartylistController::class, 'getPartylists']);
    Route::post('/add-Partylist', [PartylistController::class, 'addPartylist']);
    Route::put('/edit-Partylist/{id}', [PartylistController::class, 'editPartylist']);
    Route::delete('/delete-Partylist/{id}', [PartylistController::class, 'deletePartylist']);
    //users
    Route::get('/get-Users', [UserController::class, 'getUsers']);
    Route::post('/add-User', [UserController::class, 'addUser']);
    Route::put('/edit-User/{id}', [UserController::class, 'editUser']);
    Route::delete('/delete-User/{id}', [UserController::class, 'deleteUser']);
    //Application
    Route::get('/get-Applications', [ApplicationController::class, 'getApplications']);
    Route::post('/add-Application', [ApplicationController::class, 'addApplication']);
    Route::put('/edit-Application/{id}', [ApplicationController::class, 'editApplication']);
    Route::delete('/delete-Application/{id}', [UseApplicationControllerrController::class, 'deleteApplication']);
    //Position
    Route::get('/get-Positions', [PositionController::class, 'getPositions']);
    Route::post('/add-Position', [PositionController::class, 'addPosition']);
    Route::put('/edit-Position/{id}', [PositionController::class, 'editPosition']);
    Route::delete('/delete-Position/{id}', [PositionController::class, 'deletePosition']);
    //logout
    Route::post('/logout', [AuthenticationController::class, 'logout']);

});
