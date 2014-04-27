<?php

require 'composers.php';

\Route::get('/larapress', 'Larapress\Larapress\AdminController@index');