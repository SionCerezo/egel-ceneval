<?php
namespace App\Helpers;

class PropertyHelpers {

    const property = self::class.'get';

    /**
     * Obtiene el valor de una variable especificada en el folder de configuracion 'config/properties'.
     *
     * @param string $prop_name El nombre de la propiedad en sintaxis punto (dot syntax).
     * @param mixed $default_value Un valor por default a devolver si el nombre de la propiedad
     * no se encuentra.
     *
     * @return mixed El valor de la variable que coincide con $prop_name en el archivo de configuracion
     * especificado.
     */
    public static function get($prop_name, $default_value = null){
        if( isset($default_value) )
            return config("properties.$prop_name", $default_value);
        else
            return config("properties.$prop_name");
    }
}

/**
 * Obtiene el valor de una variable especificada en el folder de configuracion 'config/properties'.
 *
 * @param string $prop_name El nombre de la propiedad en sintaxis punto (dot syntax).
 * @param mixed $default_value Un valor por default a devolver si el nombre de la propiedad
 * no se encuentra.
 *
 * @return mixed El valor de la variable que coincide con $prop_name en el archivo de configuracion
 * especificado.
 */
function property($prop_name, $default_value = null){
    PropertyHelpers::get($prop_name, $default_value);
}
?>
