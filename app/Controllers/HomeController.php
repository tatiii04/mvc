<?php

namespace App\Controllers;

class HomeController extends Controller
{
    public function index() 
    {
        return $this->view('home', [
            'title' => 'Home',
            'description' => 'Esta es la pagina home'
        ]);
    }

}