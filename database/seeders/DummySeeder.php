<?php

namespace Database\Seeders;

use App\Models\Colaborador;
use App\Models\Convocatoria;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seedAlumnos();
        $this->seedPeriodos();
        $this->seedConvocatorias();
    }

    private function seedConvocatorias(){
        Convocatoria::create([
            'titulo'=>'Convocatoria Verano 2021',
            'descripcion'=>'Aplicación de examen para el perido 2021',
            'fecha_inicio'=> Carbon::now(),
            'fecha_fin'=> Carbon::now()->addMonth(1),
            'periodo_id' => DB::table('periodos')->select('id')->limit(1)->get()->first()->id,
            'status_id' => 'active',
            'create_user_id' => Colaborador::first()->id,
            'create_user_type' => Colaborador::class,
        ]);
    }

    private function seedPeriodos(){
        DB::table('periodos')->insert([
            'periodo_id' => 'verano',
            'year' => '2021',
        ]);
    }

    private function seedAlumnos()
    {
        DB::table('colaboradores')->delete();
        Colaborador::create([
            'nombre'=> 'Juan',
            'ap_paterno'=> 'Sanchez',
            'ap_materno'=> 'Lopez',
            'matricula'=> '123456789',
            'email'=> 'juan@gmail.com',
            'telefono'=> '11 22 33 44 55',
            'password'=> '123123123',
            'pass_decifrada'=> '123123123',
            'carrera_id'=> 'lcc',
        ]);
    }
}
