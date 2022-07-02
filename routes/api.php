<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


$group=[
    'middleware'    => 'api',
    'namespace'     => 'App\Http\Controllers'
];


Route::group(
    $group,
    function($router){
        $province="ProvinceController";
        Route::resource('/province',$province);
    }
);