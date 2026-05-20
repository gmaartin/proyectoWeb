<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    protected $table = 'inscripciones';

    protected $fillable = [
        'user_id',
        'taller_id',
        'asistio',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function taller()
    {
        return $this->belongsTo(Taller::class);
    }
}