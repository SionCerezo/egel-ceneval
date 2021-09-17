<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postulacion extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'postulaciones';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'convocatoria_id',
    ];

    /**
     * Obtiene el Alumno al que pertenece la postulacion.
     */
    public function alumno(){
        return $this->belongsTo(Alumno::class);
    }

    /**
     * Obtiene la Convocatoria a la que pertenece la postulacion.
     */
    public function convocatoria(){
        return $this->belongsTo(Convocatoria::class);
    }

    /**
     * Obtiene el estatus de la postulacion.
     */
    public function status(){
        return $this->belongsTo(Status::class);
    }

    /**
     * Get the files for the postulacion.
     */
    public function files()
    {
        return $this->hasMany(File::class);
    }
}
