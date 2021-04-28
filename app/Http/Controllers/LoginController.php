<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //Este metodo nos devuelve el index pero del login
    public function __invoke(){
        return view('login');
    }
    //El metodo de aquí nos muestra cuando se quiere crear un nuevo usuario ? Preguntar a equipo
}
