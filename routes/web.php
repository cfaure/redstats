<?php

use Carbon\Carbon;

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

\DB::connection('mysql')->listen(function ($sql) {
    // var_dump($sql->sql);
});

Route::get('/', function () {
    return view('app');
});

Route::get('/test', function () {
    $i = App\Indicator::create([
        'name' => 'vehicules_num',
    ]);
    App\Measure::create([
        'indicator_id' => $i->id,
        'value'        => 100000,
        'issued_at'    => Carbon::now(),
    ]);
    return App\Measure::find(1);
});

Route::get('/reports', 'ReportsController@show');
