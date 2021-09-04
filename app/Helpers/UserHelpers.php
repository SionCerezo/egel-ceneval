<?php
namespace App\Helpers;

use App\Models\Admin;
use App\Models\Colaborador;
use Illuminate\Support\Facades\Auth;

class UserHelpers {

    /**
     * Recupera la ruta HOME correspondiente al usuario recibido, si el $user es null entonces
     * el usuario evaluado es el actualmente autenticado, si no hay ninguno, se regresa '/'.
     *
     * @param  \App\Models\Admin|\App\Models\Admin|\App\Models\Admin $user
     * @return String El nombre de la ruta.
     */
    public static function userHomePath( $user = null){
        $homePath = '/';
        if( $user==null ){
            $user = Auth::user();
        }
        if( $user != null ){
            switch ( $user->user_type ) {
                case Admin::class:
                    $homePath = route('admin.home');
                    break;
                case Colaborador::class:
                    $homePath = route('admin.home');
                    break;

                default:
                    $homePath = route('alumno.home');
                    break;
            }
        }
        return $homePath;
    }
}
?>
