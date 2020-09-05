<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {

    // Members routes
    Route::resource('members', 'Admin\MembersController');

    // Clients routes
    Route::resource('clients', 'Admin\ClientsController');

    // Projects routes
    Route::resource('projects', 'Admin\ProjectsController');
    // get Project by hash link
    Route::get('/projects/hash/{project_link}', 'Admin\ProjectsController@getProjectByLink')->name('projects.bylink');

});
