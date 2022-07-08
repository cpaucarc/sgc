<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = Hash::make('password');

        /* User Administrador */
        User::create([
            'name' => 'Pedro el Administrador',
            'uuid' => Str::uuid(),
            'persona_id' => null,
            'email' => 'prueba@mail.com',
            'email_verified_at' => now(),
            'password' => $password,
            'remember_token' => Str::random(10)
        ])->assignRole('Administrador');

        /* User Docente */
        User::create([
            'name' => 'VERONICA ALBERTO', // Enfermeria
            'uuid' => Str::uuid(),
            'persona_id' => 294,
            'email' => 'docente1@mail.com',
            'email_verified_at' => now(),
            'password' => $password,
            'remember_token' => Str::random(10)
        ])->assignRole('Docente');

        User::create([
            'name' => 'SANDRA CRUZ', // Obstetricia
            'uuid' => Str::uuid(),
            'persona_id' => 475,
            'email' => 'docente2@mail.com',
            'email_verified_at' => now(),
            'password' => $password,
            'remember_token' => Str::random(10)
        ])->assignRole('Docente');

        /* User Director de Escuela y Docente */
        User::create([
            'name' => 'SILVIA REYES',
            'uuid' => Str::uuid(),
            'persona_id' => 293,
            'email' => 'director1@mail.com',
            'email_verified_at' => now(),
            'password' => $password,
            'remember_token' => Str::random(10)
        ])->assignRole('Dirección de Escuela', 'Docente');

        User::create([
            'name' => 'GILMA REYES',
            'uuid' => Str::uuid(),
            'persona_id' => 473,
            'email' => 'director2@mail.com',
            'email_verified_at' => now(),
            'password' => $password,
            'remember_token' => Str::random(10)
        ])->assignRole(['Dirección de Escuela']);

        /* User Estudiante */
        User::create([
            'name' => 'Carlitos el Enfermero Estudiante',
            'uuid' => Str::uuid(),
            'persona_id' => null,
            'email' => 'estudiante1@mail.com',
            'email_verified_at' => now(),
            'password' => $password,
            'remember_token' => Str::random(10)
        ])->assignRole('Estudiante');

        User::create([
            'name' => 'Emilio el Obstetra Estudiante',
            'uuid' => Str::uuid(),
            'persona_id' => null,
            'email' => 'estudiante2@mail.com',
            'email_verified_at' => now(),
            'password' => $password,
            'remember_token' => Str::random(10)
        ])->assignRole('Estudiante');

        /* User Decanatura */
        User::create([
            'name' => 'BIBIANA LEON',
            'uuid' => Str::uuid(),
            'persona_id' => 307,
            'email' => 'decanofcm@mail.com',
            'email_verified_at' => now(),
            'password' => $password,
            'remember_token' => Str::random(10)
        ])->assignRole('Decanatura');
    }
}
