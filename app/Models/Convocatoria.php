<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Convocatoria extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title','description','start_date','end_date'];

    public function author()
    {
        return $this->morphTo(__FUNCTION__,'create_user_type','create_user_id');
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function periodo(){
        return $this->belongsTo(Periodo::class);
    }

    public function getInicioAttribute()
    {
        return Str::title($this->start_date->isoFormat('MMM D, YYYY'));
    }

    /**
     * Obtiene las Postulaciones de la Convocatoria.
     */
    public function postulaciones()
    {
        return $this->hasMany(Postulacion::class);
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'email_verified_at' => 'datetime',
    ];
}
