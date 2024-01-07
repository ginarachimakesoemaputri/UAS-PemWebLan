<?php
namespace App\Controllers;

class Blog extends BaseController{
    public function index(){
        echo 'hello world';
        return view('BlogView');
    }

    public function indexHome(): string
    {
        return view('welcome_message');
    }
}