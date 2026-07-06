<?php

use Lib\Route;

Route::get('/', function() {
    echo 'hola desde la página principal';
});

Route::get('/contact', function() {
    echo 'hola desde la página contacto';
});

Route::get('/about', function() {
    echo 'hola desde la página acerca de';
});

Route::dispatch();