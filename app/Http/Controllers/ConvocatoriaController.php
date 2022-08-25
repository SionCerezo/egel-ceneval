<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConvocatoriaRequest;
use App\Models\Convocatoria;
use App\Models\Periodo;
use App\Models\Status;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\map;

class ConvocatoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $convocatorias = Convocatoria::all()->sortByDesc('created_at');
        return view('convocatoria.index')->with('convocatorias', $convocatorias);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $periods = DB::table('periodos_catalog')->get();
        $startDate = Carbon::now()->toISOString();

        return view('convocatoria.create')->with('periods', $periods)
            ->with('startDate', $startDate);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConvocatoriaRequest $request)
    {
        $convocatoria = new Convocatoria($request->all());
        $convocatoria->create_user_id = session('fulluser')->id;
        $convocatoria->create_user_type = session('fulluser')::class;
        $convocatoria->status_id = 'inactive';

        $year = (new Carbon( $request->start_date ))->year;
        $dataPeriod = ['year' => $year, 'periodo_id' => $request->period];

        DB::transaction(function () use ($convocatoria, $dataPeriod){
            $period = Periodo::updateOrCreate($dataPeriod);
            $convocatoria->periodo_id = $period->id;
            $convocatoria->save();
        });

        return redirect()->route('admin.convocatoria.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        Convocatoria::findOrFail($id)->delete();
        return response(['success' => true]);
    }

    public function findOrThrow()
    {
        # code...
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStatus($convId, $statusId)
    {
        $convocatoria = Convocatoria::find($convId);
        $convStatus = $convocatoria->status;
        if( $convStatus->actions->contains('id', $statusId) ){
            $status = Status::find($statusId);
            $convocatoria->status_id = $statusId;
            $convocatoria->save();

            $actionsResp = $status->actions->map( function($action, $index) use ($convocatoria) {
                $urlArgs = ['id' => $convocatoria->id, 'status' => $action['id']];
                $action['route'] = route('admin.convocatoria.update.status', $urlArgs);
                return $action;
            });
            $response = $status->toArray();
            $response['actions'] = $actionsResp;

            return response()->json($response);
        }else{
            // abort('422');
        }
    }
}
