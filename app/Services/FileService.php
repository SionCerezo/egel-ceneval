<?php

namespace App\Services;

use App\Http\Controllers\PostulacionController;
use Illuminate\Support\Str;
use ZipArchive;

class FileService {

    /**
     * Expresion regular para comprimir los archivos que coincidan con este patron en un zip.
     *
     * @var string
     */
    public const ZIPED_REGEX = "/\..*$/";

    public function createZipForAlumno($alumno)
    {
        $zipFileName = "{$alumno->matricula}_" . Str::slug($alumno->fullName, '-');
        $zipPath = public_path($zipFileName);

        $docsSource = PostulacionController::STORE_PATH . $alumno->matricula;
        $docsSourcePath = storage_path("app/{$docsSource}/");

        $zip = new ZipArchive;
        if ($zip->open($zipPath, ZipArchive::CREATE) === TRUE) {
            $options = ['add_path' => $zipFileName, 'remove_path' => $docsSourcePath ];
            $zip->addPattern($this::ZIPED_REGEX, $docsSourcePath, $options);
            $zip->close();
        }

        return $zipPath;
    }

    /**
     * Almacena en el path especificado por PostulacionController::STORE_PATH los archivos
     * recibidos en un Request.
     *
     * @param array|null $documents Un array con los datos de los archivos a cargar definidos en los
     *  files[] de un Request.
     * @param array|null $middlePath Path intermedio entre STORE_PATH y el directorio con los documentos
     *  a almacenar.
     * @return Illuminate\Support\Collection Una coleccion con los paths donde se almacenaron
     *  los archivos o una coleccion vacia si no se recibieron archivos.
     */
    public function storeFiles($documents, $path = ''){
        $paths = collect();

        if( isset($documents) && count($documents)>0 ){
            $prefixFile = basename($path) . "_";
            foreach($documents as $document){
                $fileName = $prefixFile . $document->getClientOriginalName();
                $paths->push( $document->storeAs($path, $fileName) );
            }
        }

        return $paths;
    }
}
