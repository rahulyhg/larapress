<?php
namespace Larapress\Larapress\Composers;

class PackageComposer{
    
    public function compose($view){
        $view->with('packages', \Config::get('larapress::packages'));
    }
}