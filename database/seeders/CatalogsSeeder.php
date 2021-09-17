<?php

namespace Database\Seeders;

use App\Models\Carrera;
use App\Models\PeriodoCatalog;
use App\Models\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatalogsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seedCarreras();
        $this->seedPeriodos();
        $this->seedStatus();
    }

    private function seedCarreras(){
        DB::table('carreras_catalog')->delete();

        Carrera::create(['id'=>'icc','name'=>'Ingeniería en Ciencias de la Computación'])
            ->save();

        Carrera::create(['id'=>'lcc','name'=>'Licenciatura en Ciencias de la Computación'])
            ->save();

        Carrera::create(['id'=>'iti','name'=>'Ingeniería en Tecnologías de la Información'])
            ->save();
    }

    private function seedPeriodos()
    {
        DB::table('periodos_catalog')->delete();

        PeriodoCatalog::create(['id'=>'primavera','name'=>'Primavera'])->save();
        PeriodoCatalog::create(['id'=>'verano','name'=>'Verano'])->save();
        PeriodoCatalog::create(['id'=>'otono','name'=>'Otoño'])->save();
    }

    private function seedStatus()
    {
        DB::table('status_catalog')->delete();

        Status::create(['id'=>'active', 'value'=>'Activa'])->save();
        Status::create(['id'=>'pending', 'value'=>'Pendiente'])->save();
        Status::create(['id'=>'close', 'value'=>'Cerrada'])->save();
        // Añadir las que falten ...
    }
}
