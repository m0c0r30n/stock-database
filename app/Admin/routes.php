<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');
    $router->get('makereviewpdf/{id}', 'MakePdfController@index');
    $router->get('maketoppdf/{id}', 'MakePdfController@top');
    $router->get('makeirekaepdf/{id}', 'MakePdfController@irekae');
    // $router->get('s3fileup', 'S3fileUpController@up');
    // $router->post('s3fileup', 'S3fileUpController@s3fileup');
    $router->resource('s3fileup', 'S3fileUpController');
    $router->resource('todoi', 'TodoController');
    $router->resource('circle', 'CircleAdminController');
    $router->resource('review', 'ReviewNoteAdminController');
    $router->resource('attention', 'AttentionNoteController');
    $router->resource('irekaekensho', 'IrekaeKenshoController');
    $router->resource('stockdatabase', 'StockDatabaseController');
    $router->resource('lionnote', 'LionnoteDatabaseController');
    $router->resource('indivilionpdf', 'IndiviLionpdfController');
});
