<?php
use Illuminate\Support\Str;

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
function formatDate($date, $format = 'MMM D, YYYY'){
    return Str::title($date->isoFormat($format));
}
?>
