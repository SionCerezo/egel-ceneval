<?php

namespace App\Services;

use App\Http\Controllers\PostulacionController;
use App\Models\Convocatoria;
use App\Models\File;
use App\Models\Postulacion;
use App\Exceptions\Custom\ApplicationException;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Throwable;

class PostulacionService {
    /**
     * Service to handle files.
     */
    public $fileService;

    public function __construct(FileService $fileService) {
        $this->fileService = $fileService;
    }

    public function getCurrents()
    {
        $activeConvocatoria = Convocatoria::where('status_id','active')
            ->orderByDesc('created_at')->first();

        return $activeConvocatoria == null ? collect() : $activeConvocatoria->postulaciones;
    }

    /**
     * Crea una postulacion para el usuario logueado. Almacena en BD la informacion y en disco los
     * documentos cargados si es que se envio alguno.
     *
     * @param array $atributes Los atributos de la postulación.
     * @param array|null $documents los archivos cargados para asociar a la postulación.
     */
    public function save(array $attributes, array $documents = null)
    {
        $postulacion = new Postulacion($attributes);
        $postulacion->alumno_id = fullUserAuth()->id;
        $postulacion->status_id = 'pending';

        $path = PostulacionController::STORE_PATH
            . "convocatoria_" . $attributes['convocatoria_id'] . "/"
            . fullUserAuth()->matricula;
        try{
            $paths = $this->fileService->storeFiles($documents, $path);
            $fileModels = $paths->map(fn($path, $key) => new File(['path' => $path]));

            DB::transaction(function () use ($postulacion, $fileModels) {
                $postulacion->save();
                if( $fileModels->isNotEmpty() ){
                    $postulacion->files()->saveMany($fileModels);
                }
            });
        }catch(Throwable $exc){
            if( Storage::exists($path) ){
                Storage::deleteDirectory($path);
            }
            throw new ApplicationException('001', $exc);
        }
    }
}
