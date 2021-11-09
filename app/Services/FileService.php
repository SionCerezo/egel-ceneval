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
}
