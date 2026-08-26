<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function connexion () {
        return view('Espace_admin.connexion');
    }
}
