<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Taller extends Model
{
    protected $table = 'talleres';

    protected $fillable = [
        'evento_id',
        'titulo',
        'descripcion',
        'ponente',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'aula',
        'aforo',
    ];

    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class);
    }

    public function materiales()
    {
        return $this->hasMany(Material::class);
    }

    public function plazasOcupadas()
    {
        return $this->inscripciones()->count();
    }

    public function plazasDisponibles()
    {
        return $this->aforo - $this->plazasOcupadas();
    }
}