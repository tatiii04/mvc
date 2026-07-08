<?php

namespace App\Controllers;

namespace App\Models\Contact;

class HomeController extends Controller
{
    public function index() 
    {

        $contactModel = new Contact();

        $contactModel->delete(11);
        /*return $contactModel->all();*/

        return "Eliminado";

        return $this->view('home', [
            'title' => 'Home',
            'description' => 'Esta es la pagina home'
        ]);
    }

}