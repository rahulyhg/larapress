<?php
namespace Larapress\Larapress;

class AdminController extends \BaseController{

    public function __construct(){
        $this->beforeFilter('auth');
    }

    public function index(){
        
        return \View::make('larapress::index');
    }
    
}