<?php
namespace App\Logging;

use Monolog\Formatter\LineFormatter;

/**
 * Clase para especificar un formato personalizado para los mensajes de logging
 * que sean propios de la aplicacion.
 * TODO: verificar que si se vaya a ocupar esta clase en App.config.logging
 */
class CustomFormatter{
    /**
     * Customize the given logger instance.
     *
     * @param  \Illuminate\Log\Logger  $logger
     * @return void
     */
    public function __invoke($logger){
        foreach ($logger->getHandlers() as $handler) {
            $handler->setFormatter(new LineFormatter(
                '[%datetime%] %channel%.%level_name%: %context% %message% %extra%'
            ));
        }
    }
}
