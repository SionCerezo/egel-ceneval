<?php

namespace App\Http\Controllers;

use App\Models\Convocatoria;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function home()
    {
        $postCounts = Convocatoria::select(
                'status_catalog.value', 'color', DB::raw('count(*) as status_count'))
            ->where('convocatorias.status_id','active')
            ->join('postulaciones', 'convocatorias.id', '=', 'postulaciones.convocatoria_id')
            ->join('status_catalog', 'postulaciones.status_id', '=', 'status_catalog.id')
            ->groupBy('status_catalog.id')->get();

        $postulationsTotal = $postCounts->sum(fn($post) =>  $post->status_count);

        return view('admin.home')->with('postulationTotals', $postCounts)
            ->with('postulationsTotal', $postulationsTotal);
    }

    public function retrieveConvovatorias()
    {
        $convocatoria = Convocatoria::where('status_id','active')
            ->orderByDesc('created_at')->limit(1)->first();
        return view('convocatoria.active')->with('convocatoria', $convocatoria);
    }
}
