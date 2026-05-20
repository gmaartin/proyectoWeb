<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Evento;
use App\Models\Taller;
use App\Models\Inscripcion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $asistente1 = User::create([
            'name' => 'Asistente1 Demo',
            'email' => 'asistente1@techconf.com',
            'password' => Hash::make('12345678'),
            'rol' => 'asistente',
        ]);

        $asistente2 = User::create([
            'name' => 'Asistente2 Demo',
            'email' => 'asistente2@techconf.com',
            'password' => Hash::make('12345678'),
            'rol' => 'asistente',
        ]);

        User::create([
            'name' => 'Organizador Demo',
            'email' => 'organizador@techconf.com',
            'password' => Hash::make('12345678'),
            'rol' => 'organizador',
        ]);

        $evento = Evento::create([
            'titulo' => 'TechConf 2026',
            'descripcion' => 'Conferencia tecnológica sobre programación, inteligencia artificial, ciberseguridad y desarrollo web.',
            'fecha_inicio' => '2026-06-10',
            'fecha_fin' => '2026-06-12',
            'lugar' => 'Granada',
        ]);

        $tallerLaravel = Taller::create([
            'evento_id' => $evento->id,
            'titulo' => 'Introducción a Laravel',
            'descripcion' => 'Taller práctico para aprender los fundamentos de Laravel y el patrón MVC.',
            'ponente' => 'Laura Sánchez',
            'fecha' => '2026-06-10',
            'hora_inicio' => '10:00',
            'hora_fin' => '12:00',
            'aula' => 'Aula 1',
            'aforo' => 20,
        ]);

        Taller::create([
            'evento_id' => $evento->id,
            'titulo' => 'Inteligencia Artificial aplicada',
            'descripcion' => 'Sesión sobre aplicaciones reales de la inteligencia artificial en proyectos web.',
            'ponente' => 'Carlos Martín',
            'fecha' => '2026-06-11',
            'hora_inicio' => '16:00',
            'hora_fin' => '18:00',
            'aula' => 'Aula 2',
            'aforo' => 15,
        ]);

        Taller::create([
            'evento_id' => $evento->id,
            'titulo' => 'Ciberseguridad básica',
            'descripcion' => 'Buenas prácticas de seguridad para aplicaciones web modernas.',
            'ponente' => 'Marta López',
            'fecha' => '2026-06-12',
            'hora_inicio' => '09:30',
            'hora_fin' => '11:30',
            'aula' => 'Aula 3',
            'aforo' => 10,
        ]);

        Inscripcion::create([
            'user_id' => $asistente1->id,
            'taller_id' => $tallerLaravel->id,
            'asistio' => false,
        ]);
    }
}