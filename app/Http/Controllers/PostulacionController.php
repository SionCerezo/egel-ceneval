<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\File;
use App\Models\Postulacion;
use App\Services\FileService;
use App\Services\PostulacionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use ZipArchive;

class PostulacionController extends Controller
{

    public $postulacionService;

    public $fileService;

    public function __construct(PostulacionService $postulacionService,
        FileService $fileService)
    {
        $this->postulacionService = $postulacionService;
        $this->fileService = $fileService;
    }

    /**
     * El path raiz para almacenar los archivos de los alumnos.
     *
     * @var string
     */
    public const STORE_PATH = 'postulaciones/';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentPostulations = $this->postulacionService->getCurrents();
        return view('postulacion.index')->with('postulaciones', $currentPostulations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($conv_id)
    {
        return view('postulacion.create')
                ->with('alumno', session('fulluser'))
                ->with('convocatoria_id', $conv_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'convocatoria_id' => ['required', 'exists:convocatorias,id'],
            'documents.*' => ['required','file','mimes:txt,pdf,docx,jpg,jpeg,png,bmp,gif,svg,webp']
        ]);

        $postulacion = new Postulacion($request->all());
        $postulacion->alumno_id = fullUserAuth()->id;
        $postulacion->status_id = 'pending';

        $paths = collect();
        $prefixFile = fullUserAuth()->matricula."_";
        foreach($request->documents as $document){
            $fileName = $prefixFile . $document->getClientOriginalName();
            $path = $this::STORE_PATH . fullUserAuth()->matricula;
            $paths->push( $document->storeAs($path, $fileName) );
        }

        $fileModels = $paths->map(function($path, $key){
            return new File(['path' => $path]);
        });

        DB::transaction(function () use ($postulacion, $fileModels) {
            $postulacion->save();
            $postulacion->files()->saveMany($fileModels);
        });

        return redirect()->route('alumno.home')->with('success', true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $postulacion = Postulacion::find($id);
        $userType = Auth::user()->user_type == Alumno::class ? 'alumno' : 'admin';

        return view("$userType.postulacion.show")->with('postulacion', $postulacion)
                ->with('files', $postulacion->files);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function downloadFiles($id)
    {
        $alumno = Postulacion::findOrFail($id)->alumno;

        $zipPath = $this->fileService->createZipForAlumno($alumno);

        /* Create Download Response */
        if(file_exists($zipPath)){
            $headers = ['Content-Type' => 'application/octet-stream'];
            return response()->download($zipPath, basename($zipPath) . ".zip", $headers)
                ->deleteFileAfterSend(true);
        }

        return view('createZip');
    }
}
