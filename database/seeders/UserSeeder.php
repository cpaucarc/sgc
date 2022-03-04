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
            'codigo' => rand(100, 999) . '.' . rand(1000, 9999) . '.' . rand(100, 999),
            'email' => 'prueba@mail.com',
            'email_verified_at' => now(),
            'password' => $password,
            'remember_token' => Str::random(10)
        ])->assignRole('Administrador');

        /* User Docente */
        User::create([
            'name' => 'Peter el Docente',
            'uuid' => Str::uuid(),
            'codigo' => rand(100, 999) . '.' . rand(1000, 9999) . '.' . rand(100, 999),
            'email' => 'docente1@mail.com',
            'email_verified_at' => now(),
            'password' => $password,
            'remember_token' => Str::random(10)
        ])->assignRole('Docente');
        User::create([
            'name' => 'Arnol el Docente',
            'uuid' => Str::uuid(),
            'codigo' => rand(100, 999) . '.' . rand(1000, 9999) . '.' . rand(100, 999),
            'email' => 'docente2@mail.com',
            'email_verified_at' => now(),
            'password' => $password,
            'remember_token' => Str::random(10)
        ])->assignRole('Docente');

        /* User Director de Escuela y Docente */
        User::create([
            'name' => 'Pepe el Director',
            'uuid' => Str::uuid(),
            'codigo' => rand(100, 999) . '.' . rand(1000, 9999) . '.' . rand(100, 999),
            'email' => 'director1@mail.com',
            'email_verified_at' => now(),
            'password' => $password,
            'remember_token' => Str::random(10)
        ])->assignRole('Dirección de Escuela', 'Docente');
        User::create([
            'name' => 'Fidencio el Director',
            'uuid' => Str::uuid(),
            'codigo' => rand(100, 999) . '.' . rand(1000, 9999) . '.' . rand(100, 999),
            'email' => 'director2@mail.com',
            'email_verified_at' => now(),
            'password' => $password,
            'remember_token' => Str::random(10)
        ])->assignRole(['Dirección de Escuela']);

        /* User Estudiante */
        User::create([
            'name' => 'Carlitos el Enfermero Estudiante',
            'uuid' => Str::uuid(),
            'codigo' => rand(100, 999) . '.' . rand(1000, 9999) . '.' . rand(100, 999),
            'email' => 'estudiante1@mail.com',
            'email_verified_at' => now(),
            'password' => $password,
            'remember_token' => Str::random(10)
        ])->assignRole('Estudiante');
        User::create([
            'name' => 'Emilio el Obstetra Estudiante',
            'uuid' => Str::uuid(),
            'codigo' => rand(100, 999) . '.' . rand(1000, 9999) . '.' . rand(100, 999),
            'email' => 'estudiante2@mail.com',
            'email_verified_at' => now(),
            'password' => $password,
            'remember_token' => Str::random(10)
        ])->assignRole('Estudiante');

        /* User Decanatura */
        User::create([
            'name' => 'Demitrio el Decano',
            'uuid' => Str::uuid(),
            'codigo' => rand(100, 999) . '.' . rand(1000, 9999) . '.' . rand(100, 999),
            'email' => 'decano1@mail.com',
            'email_verified_at' => now(),
            'password' => $password,
            'remember_token' => Str::random(10)
        ])->assignRole('Decanatura');
    }
}
