<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectWBSController;
use App\Http\Controllers\DeliverableController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\WorkAmountController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\CandidatesController;

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

Route::group(['middleware'=>'auth'], function(){
    
    Route::resource('projects', ProjectController::class);
    
    Route::resource('projects.wbs', ProjectWBSController::class)->parameters([
        'wbs' => 'wbs'
    ])->scoped();
    
    Route::resource('projects.deliverables', DeliverableController::class);
    
    Route::post('/projects/{project}/team', [TeamController::class, 'store']);
    
    Route::get('/projects/{project}/team', [TeamController::class, 'index']);
    
    Route::get('/projects/{project}/team/edit', [TeamController::class, 'edit']);
    
    Route::resource('statuses', StatusController::class);
    
    Route::resource('work_units', WorkAmountController::class);
    
    Route::resource('candidates', CandidatesController::class);
    
});

Auth::routes();
