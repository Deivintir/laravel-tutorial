<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/tasks/list', function(){
    return view('home');
})->name('home'); 

Route::get('/tasks/new/{newtask}', function($newtask){

});

Route::get('/tasks/erase/{taskid}', function($taskid){
    
});

Route::get('/tasks/done{taskid}', function($taskid){

});
?>