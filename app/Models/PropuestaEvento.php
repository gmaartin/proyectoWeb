<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropuestaEvento extends Model
{
    protected $table = 'propuestas_eventos';

    protected $fillable = [
        'user_id',
        'titulo',
        'descripcion',
        'ponente',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'aula',
        'aforo',
        'estado',
        'comentario_organizador',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}