<?php

require 'composers.php';

\Route::get('elfinder', 'Barryvdh\Elfinder\ElfinderController@showIndex');
\Route::any('elfinder/connector', 'Barryvdh\Elfinder\ElfinderController@showConnector');
\Route::get('elfinder/tinymce', 'Barryvdh\Elfinder\ElfinderController@showTinyMCE4');


\Route::resource('/larapress', 'Larapress\Larapress\AdminController');
