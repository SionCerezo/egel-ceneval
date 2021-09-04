<?php

/**
 * Obtiene la implementacion del usuario logeado, es decir, un Admin, un Alumno o un
 * Colaborador.
 *
 * @return Admin|Alumno|Colaborador El modelo del usuario actual en sesion.
 */
function fullUserAuth(){
    return session('fulluser');
}

?>
