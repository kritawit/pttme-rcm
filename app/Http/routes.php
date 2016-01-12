<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/',['as'=>'project','uses'=>'ProjectController@index']);
Route::get('/project',['as'=>'project','uses'=>"ProjectController@index"]);
Route::get('/guideline', function(){
    return View::make('guideline');
});
Route::get('/about', function(){
    return View::make('about');
});
Route::get('/contact', function(){
    return View::make('contact');
});
Route::controller('project','ProjectController');
Route::controller('basic-data-setup','BasicDataSetupController');
Route::controller('asset-register','AssetRegisterController');
Route::controller('report','ReportController');
Route::controller('package-assumption','PackageAssumptionController');
Route::controller('reference-data/equipment','EquipmentController');
Route::controller('reference-data/task','TaskController');
Route::controller('reference-data/failure','FailureController');
Route::controller('/','Auth\AuthController');
