<?php
namespace Larapress\Larapress;

class AdminController extends \BaseController{
    
    public function index(){
        
        return \View::make('larapress::index');
    }
    
}