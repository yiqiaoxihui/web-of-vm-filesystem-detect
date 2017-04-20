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

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
// 密码重置链接请求路由...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');
// 密码重置路由...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::get('/', 'YkController@home');
Route::group(['middleware' => 'auth'], function() {
    Route::get('home', 'YkController@index');//近7日游客走势
    Route::get('yktrend', 'YkController@index');//近7日游客走势
    Route::get('ykNumber', 'YkController@ykNumber');//游客数量走势12月
    Route::get('ykType', 'YkController@ykType');//游客类型分析
    Route::post('yearOfyktype', 'YkController@yearOfyktype');//游客类型分析
    Route::get('ykSource', 'YkController@ykSource');//游客客源地分析
    Route::post('yearOfyksource', 'YkController@yearOfyksource');//游客客源地分析
    //同期比
    Route::get('pepCompare','CompareController@pepCompare');//游客同期比
    Route::post('yearOfYkCompare','CompareController@yearOfYkCompare');
    Route::get('incomeCompare','CompareController@incomeCompare');//收入同期比
    Route::post('yearOfIncomeCompare','CompareController@yearOfIncomeCompare');//收入同期比
    //收入分析
    Route::get('incomeSource','IncomeAnalyzeController@incomeSource');
    Route::post('yearOfIncomeSource','IncomeAnalyzeController@yearOfIncomeSource');
    Route::get('incomeSum','IncomeAnalyzeController@incomeSum');
    Route::get('incomeAccumulate','IncomeAnalyzeController@incomeAccumulate');
    //景点客流
    Route::get('spotsYk','SpotsController@spotsYk');    
});
// Route::get('home', function () {

//     return view('home/yktrend');
// });


//游客分析
Route::group(['middleware' => 'auth','namespace' => 'Admin', 'prefix' => 'admin'], function() {  
    Route::get('/', 'HomeController@index');
    Route::post('addYktrend', 'HomeController@addYktrend');
    Route::get('yktrendEdit/{id}', 'HomeController@yktrendEdit');
    Route::post('yktrendEditOk', 'HomeController@yktrendEditOk');
    //游客数量走势图
    Route::get('ykNumber', 'HomeController@ykNumber');
    Route::post('ykNumberAdd', 'HomeController@ykNumberAdd');
    Route::get('ykNumberEdit/{id}', 'HomeController@ykNumberEdit');
    Route::post('ykNumberEditOk', 'HomeController@ykNumberEditOk');
    //游客类型分析
    Route::get('ykType', 'HomeController@ykType');
    Route::post('yktypeAdd', 'HomeController@yktypeAdd');
    Route::get('ykTypeEdit/{id}', 'HomeController@ykTypeEdit');
    Route::post('ykTypeEditOk', 'HomeController@ykTypeEditOk'); 
    //游客客源地分析
    Route::get('ykSource', 'HomeController@ykSource');
    Route::post('ykSourceAdd', 'HomeController@ykSourceAdd');
    Route::get('ykSourceEdit/{id}', 'HomeController@ykSourceEdit');
    Route::post('ykSourceEditOk', 'HomeController@ykSourceEditOk');     

});
//同期比
Route::group(['middleware' => 'auth','namespace' => 'Admin', 'prefix' => 'compare'], function() {  
    //游客人数同期比
    Route::get('ykCompare', 'CompareController@ykCompare');
    Route::post('ykCompareAdd', 'CompareController@ykCompareAdd');
    Route::get('ykCompareEdit/{id}', 'CompareController@ykCompareEdit');
    Route::post('ykCompareEditOk', 'CompareController@ykCompareEditOk'); 
    //收入同期比
    Route::get('incomeCompare', 'CompareController@incomeCompare');
    Route::post('incomeCompareAdd', 'CompareController@incomeCompareAdd');
    Route::get('incomeCompareEdit/{id}', 'CompareController@incomeCompareEdit');
    Route::post('incomeCompareEditOk', 'CompareController@incomeCompareEditOk');     

});
//收入分析
Route::group(['middleware' => 'auth','namespace' => 'Admin', 'prefix' => 'incomeAnalyze'], function() {  
    //收入来源
    Route::get('incomeSource', 'IncomeAnalyzeController@incomeSource');
    Route::post('incomeSourceAdd', 'IncomeAnalyzeController@incomeSourceAdd');
    //detect
    Route::post('incomeSourceBoot', 'IncomeAnalyzeController@incomeSourceBoot');
    Route::post('incomeSourceStop', 'IncomeAnalyzeController@incomeSourceStop');
    Route::get('incomeSourceEdit/{id}', 'IncomeAnalyzeController@incomeSourceEdit');
    Route::post('incomeSourceEditOk', 'IncomeAnalyzeController@incomeSourceEditOk'); 
    //收入总计
    Route::get('incomeSum', 'IncomeAnalyzeController@incomeSum');
    Route::post('incomeSumAdd', 'IncomeAnalyzeController@incomeSumAdd');
    Route::get('incomeSumEdit/{id}', 'IncomeAnalyzeController@incomeSumEdit');
    Route::post('incomeSumEditOk', 'IncomeAnalyzeController@incomeSumEditOk');     
    //收入累计
    Route::get('incomeAccumulate', 'IncomeAnalyzeController@incomeAccumulate');
    Route::post('incomeAccumulateUpdate', 'IncomeAnalyzeController@incomeAccumulateUpdate');


});
//景点客流
Route::group(['middleware' => 'auth','namespace' => 'Admin','prefix' => 'spots'], function() {  
    //景点客流 统计
    Route::get('spotsYk', 'SpotsController@spotsYk');
    Route::post('spotsYkAdd', 'SpotsController@spotsYkAdd');
    Route::get('spotsYkEdit/{id}', 'SpotsController@spotsYkEdit');
    Route::post('spotsYkEditOk', 'SpotsController@spotsYkEditOk'); 


});