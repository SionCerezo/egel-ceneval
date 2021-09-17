<?php

namespace App\Traits;

/**
 * Trait con accesores para acceder a los atributos del modelo User.
 */
trait User
{

    /**
     * Devuelve el atributo 'email' del modelo User usando la relacion con este modelo.
     *
     * @return string El valor del atributo email de un objeto User.
     */
    public function getEmailAttribute()
    {
        return $this->user->email;
    }

    /**
     * Devuelve el tipo de usuario a partir del atributo user_type en el modelo User
     * usando la relacion con este modelo.
     *
     * @return string El qualified fullname de la clase del tipo de usuario: Alumno, Colaborador o Admin.
     */
    public function getUserTypeAttribute()
    {
        return $this->user->user_type;
    }

    public function getFullNameAttribute()
    {
        return $this->pat_surname." ".$this->mat_surname." ".$this->name;
    }
}
