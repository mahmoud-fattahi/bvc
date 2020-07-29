<?php
//Route::view('/helloworld', 'helloworld::helloworld.helloworld');
Route::view('/helloworld', 'helloworld.helloworld');
Route::get('foo', function () {
    return 'Hello World';
});