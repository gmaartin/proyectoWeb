<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'materiales';

    protected $fillable = [
        'taller_id',
        'titulo',
        'archivo',
    ];

    public function taller()
    {
        return $this->belongsTo(Taller::class);
    }
}