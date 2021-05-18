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
    protected $fillable = ['titulo','descripcion','fecha_inicio','fecha_fin'];

    public function author()
    {
        return $this->morphTo(__FUNCTION__,'create_user_type','create_user_id');
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function getInicioAttribute()
    {
        return Str::title($this->fecha_inicio->isoFormat('MMM D, YYYY'));
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'fecha_inicio' => 'datetime',
        'fecha_fin' => 'datetime',
        'email_verified_at' => 'datetime',
    ];
}
