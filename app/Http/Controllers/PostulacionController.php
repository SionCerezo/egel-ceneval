<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoggerRequest;
use App\Http\Requests\PostulacionRequest;
use App\Models\Alumno;
use App\Models\Postulacion;
use App\Services\FileService;
use App\Services\PostulacionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function store(PostulacionRequest $request) {

        $this->postulacionService->save($request->all(), $request->documents);

        return redirect()->route('alumno.postulacion')
            ->with('create-success', trans('messages.postulation.create-success'));
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
