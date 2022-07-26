<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IndicadorableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $indicadores = [
            [
                "indicador_id" => 1,
                "indicadorable_type" => "App\\Models\\Facultad",
                "indicadorable_id" => 8,
                "cod_ind_final" => "IND-048-FCM",
                "minimo" => 10.0,
                "sobresaliente" => 40.0
            ],
            [
                "indicador_id" => 1,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-048-ENF",
                "minimo" => 10.0,
                "sobresaliente" => 40.0
            ],
            [
                "indicador_id" => 1,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-048-OBS",
                "minimo" => 10.0,
                "sobresaliente" => 40.0
            ],
            [
                "indicador_id" => 2,
                "indicadorable_type" => "App\\Models\\Facultad",
                "indicadorable_id" => 8,
                "cod_ind_final" => "IND-049-FCM",
                "minimo" => 10.0,
                "sobresaliente" => 40.0
            ],
            [
                "indicador_id" => 2,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-049-ENF",
                "minimo" => 10.0,
                "sobresaliente" => 40.0
            ],
            [
                "indicador_id" => 2,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-049-OBS",
                "minimo" => 10.0,
                "sobresaliente" => 40.0
            ],
            [
                "indicador_id" => 3,
                "indicadorable_type" => "App\\Models\\Facultad",
                "indicadorable_id" => 8,
                "cod_ind_final" => "IND-050-FCM",
                "minimo" => 25.0,
                "sobresaliente" => 80.0
            ],
            [
                "indicador_id" => 3,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-050-ENF",
                "minimo" => 25.0,
                "sobresaliente" => 80.0
            ],
            [
                "indicador_id" => 3,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-050-OBS",
                "minimo" => 25.0,
                "sobresaliente" => 80.0
            ],
            [
                "indicador_id" => 4,
                "indicadorable_type" => "App\\Models\\Facultad",
                "indicadorable_id" => 8,
                "cod_ind_final" => "IND-051-FCM",
                "minimo" => 20.0,
                "sobresaliente" => 80.0
            ],
            [
                "indicador_id" => 4,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-051-ENF",
                "minimo" => 20.0,
                "sobresaliente" => 80.0
            ],
            [
                "indicador_id" => 4,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-051-OBS",
                "minimo" => 20.0,
                "sobresaliente" => 80.0
            ],
            [
                "indicador_id" => 5,
                "indicadorable_type" => "App\\Models\\Facultad",
                "indicadorable_id" => 8,
                "cod_ind_final" => "IND-052-FCM",
                "minimo" => 5.0,
                "sobresaliente" => 20.0
            ],
            [
                "indicador_id" => 5,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-052-ENF",
                "minimo" => 5.0,
                "sobresaliente" => 20.0
            ],
            [
                "indicador_id" => 5,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-052-OBS",
                "minimo" => 5.0,
                "sobresaliente" => 20.0
            ],
            [
                "indicador_id" => 6,
                "indicadorable_type" => "App\\Models\\Facultad",
                "indicadorable_id" => 8,
                "cod_ind_final" => "IND-053-FCM",
                "minimo" => 20.0,
                "sobresaliente" => 80.0
            ],
            [
                "indicador_id" => 6,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-053-ENF",
                "minimo" => 20.0,
                "sobresaliente" => 80.0
            ],
            [
                "indicador_id" => 6,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-053-OBS",
                "minimo" => 20.0,
                "sobresaliente" => 80.0
            ],
            [
                "indicador_id" => 7,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-044-ENF",
                "minimo" => 20.0,
                "sobresaliente" => 50.0
            ],
            [
                "indicador_id" => 7,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-044-OBS",
                "minimo" => 20.0,
                "sobresaliente" => 50.0
            ],
            [
                "indicador_id" => 8,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-045-ENF",
                "minimo" => 0.5,
                "sobresaliente" => 2.0
            ],
            [
                "indicador_id" => 8,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-045-OBS",
                "minimo" => 0.5,
                "sobresaliente" => 2.0
            ],
            [
                "indicador_id" => 9,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-046-ENF",
                "minimo" => 2.0,
                "sobresaliente" => 6.0
            ],
            [
                "indicador_id" => 9,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-046-OBS",
                "minimo" => 2.0,
                "sobresaliente" => 6.0
            ],
            [
                "indicador_id" => 10,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-047-ENF",
                "minimo" => 2.0,
                "sobresaliente" => 6.0
            ],
            [
                "indicador_id" => 10,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-047-OBS",
                "minimo" => 2.0,
                "sobresaliente" => 6.0
            ],
            [
                "indicador_id" => 11,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-058-ENF",
                "minimo" => 60.0,
                "sobresaliente" => 90.0
            ],
            [
                "indicador_id" => 11,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-058-OBS",
                "minimo" => 60.0,
                "sobresaliente" => 90.0
            ],
            [
                "indicador_id" => 12,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-059-ENF",
                "minimo" => 70.0,
                "sobresaliente" => 98.0
            ],
            [
                "indicador_id" => 12,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-059-OBS",
                "minimo" => 70.0,
                "sobresaliente" => 98.0
            ],
            [
                "indicador_id" => 13,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-060-ENF",
                "minimo" => 30.0,
                "sobresaliente" => 95.0
            ],
            [
                "indicador_id" => 13,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-060-OBS",
                "minimo" => 30.0,
                "sobresaliente" => 95.0
            ],
            [
                "indicador_id" => 14,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-061-ENF",
                "minimo" => 30.0,
                "sobresaliente" => 90.0
            ],
            [
                "indicador_id" => 14,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-061-OBS",
                "minimo" => 30.0,
                "sobresaliente" => 90.0
            ],
            [
                "indicador_id" => 15,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-024-ENF",
                "minimo" => 1.0,
                "sobresaliente" => 3.0
            ],
            [
                "indicador_id" => 15,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-024-OBS",
                "minimo" => 1.0,
                "sobresaliente" => 3.0
            ],
            [
                "indicador_id" => 16,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-025-ENF",
                "minimo" => 1.0,
                "sobresaliente" => 3.0
            ],
            [
                "indicador_id" => 16,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-025-OBS",
                "minimo" => 1.0,
                "sobresaliente" => 3.0
            ],
            [
                "indicador_id" => 17,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-026-ENF",
                "minimo" => 0.0,
                "sobresaliente" => 0.0
            ],
            [
                "indicador_id" => 17,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-026-OBS",
                "minimo" => 0.0,
                "sobresaliente" => 0.0
            ],
            [
                "indicador_id" => 18,
                "indicadorable_type" => "App\\Models\\Facultad",
                "indicadorable_id" => 8,
                "cod_ind_final" => "IND-001-FCM",
                "minimo" => 20.0,
                "sobresaliente" => 30.0
            ],
            [
                "indicador_id" => 19,
                "indicadorable_type" => "App\\Models\\Facultad",
                "indicadorable_id" => 8,
                "cod_ind_final" => "IND-068-FCM",
                "minimo" => 5.0,
                "sobresaliente" => 15.0
            ],
            [
                "indicador_id" => 20,
                "indicadorable_type" => "App\\Models\\Facultad",
                "indicadorable_id" => 8,
                "cod_ind_final" => "IND-069-FCM",
                "minimo" => 25.0,
                "sobresaliente" => 39.0
            ],
            [
                "indicador_id" => 21,
                "indicadorable_type" => "App\\Models\\Facultad",
                "indicadorable_id" => 8,
                "cod_ind_final" => "IND-070-FCM",
                "minimo" => 5.0,
                "sobresaliente" => 20.0
            ],
            [
                "indicador_id" => 22,
                "indicadorable_type" => "App\\Models\\Facultad",
                "indicadorable_id" => 8,
                "cod_ind_final" => "IND-071-FCM",
                "minimo" => 5.0,
                "sobresaliente" => 15.0
            ],
            [
                "indicador_id" => 23,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-021-ENF",
                "minimo" => 0.0,
                "sobresaliente" => 0.0
            ],
            [
                "indicador_id" => 23,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-021-OBS",
                "minimo" => 0.0,
                "sobresaliente" => 0.0
            ],
            [
                "indicador_id" => 24,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-022-ENF",
                "minimo" => 0.0,
                "sobresaliente" => 0.0
            ],
            [
                "indicador_id" => 24,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-022-OBS",
                "minimo" => 0.0,
                "sobresaliente" => 0.0
            ],
            [
                "indicador_id" => 25,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-023-ENF",
                "minimo" => 0.0,
                "sobresaliente" => 0.0
            ],
            [
                "indicador_id" => 25,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-023-OBS",
                "minimo" => 0.0,
                "sobresaliente" => 0.0
            ],
            [
                "indicador_id" => 26,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-016-ENF",
                "minimo" => 50.0,
                "sobresaliente" => 100.0
            ],
            [
                "indicador_id" => 26,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-016-OBS",
                "minimo" => 50.0,
                "sobresaliente" => 100.0
            ],
            [
                "indicador_id" => 27,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-017-ENF",
                "minimo" => 1.0,
                "sobresaliente" => 3.0
            ],
            [
                "indicador_id" => 27,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-017-OBS",
                "minimo" => 1.0,
                "sobresaliente" => 3.0
            ],
            [
                "indicador_id" => 28,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-019-ENF",
                "minimo" => 20.0,
                "sobresaliente" => 100.0
            ],
            [
                "indicador_id" => 28,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-019-OBS",
                "minimo" => 20.0,
                "sobresaliente" => 100.0
            ],
            [
                "indicador_id" => 29,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-020-ENF",
                "minimo" => 50.0,
                "sobresaliente" => 100.0
            ],
            [
                "indicador_id" => 29,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-020-OBS",
                "minimo" => 50.0,
                "sobresaliente" => 100.0
            ],
            [
                "indicador_id" => 30,
                "indicadorable_type" => "App\\Models\\Facultad",
                "indicadorable_id" => 8,
                "cod_ind_final" => "IND-027-FCM",
                "minimo" => 70.0,
                "sobresaliente" => 90.0
            ],
            [
                "indicador_id" => 31,
                "indicadorable_type" => "App\\Models\\Facultad",
                "indicadorable_id" => 8,
                "cod_ind_final" => "IND-028-FCM",
                "minimo" => 70.0,
                "sobresaliente" => 90.0
            ],
            [
                "indicador_id" => 32,
                "indicadorable_type" => "App\\Models\\Facultad",
                "indicadorable_id" => 8,
                "cod_ind_final" => "IND-029-FCM",
                "minimo" => 70.0,
                "sobresaliente" => 90.0
            ],
            [
                "indicador_id" => 33,
                "indicadorable_type" => "App\\Models\\Facultad",
                "indicadorable_id" => 8,
                "cod_ind_final" => "IND-030-FCM",
                "minimo" => 70.0,
                "sobresaliente" => 90.0
            ],
            [
                "indicador_id" => 34,
                "indicadorable_type" => "App\\Models\\Facultad",
                "indicadorable_id" => 8,
                "cod_ind_final" => "IND-031-FCM",
                "minimo" => 60.0,
                "sobresaliente" => 80.0
            ],
            [
                "indicador_id" => 35,
                "indicadorable_type" => "App\\Models\\Facultad",
                "indicadorable_id" => 8,
                "cod_ind_final" => "IND-009-FCM",
                "minimo" => 30.0,
                "sobresaliente" => 80.0
            ],
            [
                "indicador_id" => 36,
                "indicadorable_type" => "App\\Models\\Facultad",
                "indicadorable_id" => 8,
                "cod_ind_final" => "IND-010-FCM",
                "minimo" => 600.0,
                "sobresaliente" => 700.0
            ],
            [
                "indicador_id" => 37,
                "indicadorable_type" => "App\\Models\\Facultad",
                "indicadorable_id" => 8,
                "cod_ind_final" => "IND-011-FCM",
                "minimo" => 0.0,
                "sobresaliente" => 0.0
            ],
            [
                "indicador_id" => 38,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-012-ENF",
                "minimo" => 300.0,
                "sobresaliente" => 400.0
            ],
            [
                "indicador_id" => 38,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-012-OBS",
                "minimo" => 300.0,
                "sobresaliente" => 400.0
            ],
            [
                "indicador_id" => 39,
                "indicadorable_type" => "App\\Models\\Facultad",
                "indicadorable_id" => 8,
                "cod_ind_final" => "IND-013-FCM",
                "minimo" => 100.0,
                "sobresaliente" => 120.0
            ],
            [
                "indicador_id" => 40,
                "indicadorable_type" => "App\\Models\\Facultad",
                "indicadorable_id" => 8,
                "cod_ind_final" => "IND-014-FCM",
                "minimo" => 150.0,
                "sobresaliente" => 160.0
            ],
            [
                "indicador_id" => 41,
                "indicadorable_type" => "App\\Models\\Facultad",
                "indicadorable_id" => 8,
                "cod_ind_final" => "IND-015-FCM",
                "minimo" => 50.0,
                "sobresaliente" => 60.0
            ],
            [
                "indicador_id" => 42,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-032-ENF",
                "minimo" => 70.0,
                "sobresaliente" => 90.0
            ],
            [
                "indicador_id" => 42,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-032-OBS",
                "minimo" => 70.0,
                "sobresaliente" => 90.0
            ],
            [
                "indicador_id" => 43,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-033-ENF",
                "minimo" => 10.0,
                "sobresaliente" => 2.0
            ],
            [
                "indicador_id" => 43,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-033-OBS",
                "minimo" => 10.0,
                "sobresaliente" => 2.0
            ],
            [
                "indicador_id" => 44,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-034-ENF",
                "minimo" => 8.0,
                "sobresaliente" => 4.0
            ],
            [
                "indicador_id" => 44,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-034-OBS",
                "minimo" => 8.0,
                "sobresaliente" => 4.0
            ],
            [
                "indicador_id" => 45,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-035-ENF",
                "minimo" => 0.0,
                "sobresaliente" => 0.0
            ],
            [
                "indicador_id" => 45,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-035-OBS",
                "minimo" => 0.0,
                "sobresaliente" => 0.0
            ],
            [
                "indicador_id" => 46,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-036-ENF",
                "minimo" => 70.0,
                "sobresaliente" => 90.0
            ],
            [
                "indicador_id" => 46,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-036-OBS",
                "minimo" => 70.0,
                "sobresaliente" => 90.0
            ],
            [
                "indicador_id" => 47,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-037-ENF",
                "minimo" => 0.0,
                "sobresaliente" => 0.0
            ],
            [
                "indicador_id" => 47,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-037-OBS",
                "minimo" => 0.0,
                "sobresaliente" => 0.0
            ],
            [
                "indicador_id" => 48,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-038-ENF",
                "minimo" => 0.0,
                "sobresaliente" => 0.0
            ],
            [
                "indicador_id" => 48,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-038-OBS",
                "minimo" => 0.0,
                "sobresaliente" => 0.0
            ],
            [
                "indicador_id" => 49,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-054-ENF",
                "minimo" => 30.0,
                "sobresaliente" => 80.0
            ],
            [
                "indicador_id" => 49,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-054-OBS",
                "minimo" => 30.0,
                "sobresaliente" => 80.0
            ],
            [
                "indicador_id" => 50,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-055-ENF",
                "minimo" => 60.0,
                "sobresaliente" => 95.0
            ],
            [
                "indicador_id" => 50,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-055-OBS",
                "minimo" => 60.0,
                "sobresaliente" => 95.0
            ],
            [
                "indicador_id" => 51,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-056-ENF",
                "minimo" => 3.0,
                "sobresaliente" => 5.0
            ],
            [
                "indicador_id" => 51,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-056-OBS",
                "minimo" => 3.0,
                "sobresaliente" => 5.0
            ],
            [
                "indicador_id" => 52,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-057-ENF",
                "minimo" => 5.0,
                "sobresaliente" => 14.0
            ],
            [
                "indicador_id" => 52,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-057-OBS",
                "minimo" => 5.0,
                "sobresaliente" => 14.0
            ],
            [
                "indicador_id" => 53,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-039-ENF",
                "minimo" => 200.0,
                "sobresaliente" => 215.0
            ],
            [
                "indicador_id" => 53,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-039-OBS",
                "minimo" => 200.0,
                "sobresaliente" => 215.0
            ],
            [
                "indicador_id" => 54,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-040-ENF",
                "minimo" => 5.0,
                "sobresaliente" => 2.0
            ],
            [
                "indicador_id" => 54,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-040-OBS",
                "minimo" => 5.0,
                "sobresaliente" => 2.0
            ],
            [
                "indicador_id" => 55,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-041-ENF",
                "minimo" => 8.0,
                "sobresaliente" => 2.0
            ],
            [
                "indicador_id" => 55,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-041-OBS",
                "minimo" => 8.0,
                "sobresaliente" => 2.0
            ],
            [
                "indicador_id" => 56,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-042-ENF",
                "minimo" => 6.0,
                "sobresaliente" => 0.0
            ],
            [
                "indicador_id" => 56,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-042-OBS",
                "minimo" => 6.0,
                "sobresaliente" => 0.0
            ],
            [
                "indicador_id" => 57,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-043-ENF",
                "minimo" => 85.0,
                "sobresaliente" => 95.0
            ],
            [
                "indicador_id" => 57,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-043-OBS",
                "minimo" => 85.0,
                "sobresaliente" => 95.0
            ],
            [
                "indicador_id" => 58,
                "indicadorable_type" => "App\\Models\\Facultad",
                "indicadorable_id" => 8,
                "cod_ind_final" => "IND-062-FCM",
                "minimo" => 60.0,
                "sobresaliente" => 100.0
            ],
            [
                "indicador_id" => 58,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-062-ENF",
                "minimo" => 60.0,
                "sobresaliente" => 100.0
            ],
            [
                "indicador_id" => 58,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-062-OBS",
                "minimo" => 60.0,
                "sobresaliente" => 100.0
            ],
            [
                "indicador_id" => 59,
                "indicadorable_type" => "App\\Models\\Facultad",
                "indicadorable_id" => 8,
                "cod_ind_final" => "IND-063-FCM",
                "minimo" => 70.0,
                "sobresaliente" => 100.0
            ],
            [
                "indicador_id" => 59,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-063-ENF",
                "minimo" => 70.0,
                "sobresaliente" => 100.0
            ],
            [
                "indicador_id" => 59,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-063-OBS",
                "minimo" => 70.0,
                "sobresaliente" => 100.0
            ],
            [
                "indicador_id" => 60,
                "indicadorable_type" => "App\\Models\\Facultad",
                "indicadorable_id" => 8,
                "cod_ind_final" => "IND-065-FCM",
                "minimo" => 80.0,
                "sobresaliente" => 100.0
            ],
            [
                "indicador_id" => 60,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-065-ENF",
                "minimo" => 80.0,
                "sobresaliente" => 100.0
            ],
            [
                "indicador_id" => 60,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-065-OBS",
                "minimo" => 80.0,
                "sobresaliente" => 100.0
            ],
            [
                "indicador_id" => 61,
                "indicadorable_type" => "App\\Models\\Facultad",
                "indicadorable_id" => 8,
                "cod_ind_final" => "IND-066-FCM",
                "minimo" => 80.0,
                "sobresaliente" => 100.0
            ],
            [
                "indicador_id" => 61,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-066-ENF",
                "minimo" => 80.0,
                "sobresaliente" => 100.0
            ],
            [
                "indicador_id" => 61,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-066-OBS",
                "minimo" => 80.0,
                "sobresaliente" => 100.0
            ],
            [
                "indicador_id" => 62,
                "indicadorable_type" => "App\\Models\\Facultad",
                "indicadorable_id" => 8,
                "cod_ind_final" => "IND-067-FCM",
                "minimo" => 80.0,
                "sobresaliente" => 100.0
            ],
            [
                "indicador_id" => 62,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-067-ENF",
                "minimo" => 80.0,
                "sobresaliente" => 100.0
            ],
            [
                "indicador_id" => 62,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-067-OBS",
                "minimo" => 80.0,
                "sobresaliente" => 100.0
            ],
            [
                "indicador_id" => 63,
                "indicadorable_type" => "App\\Models\\Facultad",
                "indicadorable_id" => 8,
                "cod_ind_final" => "IND-074-FCM",
                "minimo" => 80.0,
                "sobresaliente" => 100.0
            ],
            [
                "indicador_id" => 63,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-074-ENF",
                "minimo" => 80.0,
                "sobresaliente" => 100.0
            ],
            [
                "indicador_id" => 63,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-074-OBS",
                "minimo" => 80.0,
                "sobresaliente" => 100.0
            ],
            [
                "indicador_id" => 64,
                "indicadorable_type" => "App\\Models\\Facultad",
                "indicadorable_id" => 8,
                "cod_ind_final" => "IND-075-FCM",
                "minimo" => 80.0,
                "sobresaliente" => 100.0
            ],
            [
                "indicador_id" => 64,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-075-ENF",
                "minimo" => 80.0,
                "sobresaliente" => 100.0
            ],
            [
                "indicador_id" => 64,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-075-OBS",
                "minimo" => 80.0,
                "sobresaliente" => 100.0
            ],
            [
                "indicador_id" => 65,
                "indicadorable_type" => "App\\Models\\Facultad",
                "indicadorable_id" => 8,
                "cod_ind_final" => "IND-076-FCM",
                "minimo" => 70.0,
                "sobresaliente" => 90.0
            ],
            [
                "indicador_id" => 65,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-076-ENF",
                "minimo" => 70.0,
                "sobresaliente" => 90.0
            ],
            [
                "indicador_id" => 65,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-076-OBS",
                "minimo" => 70.0,
                "sobresaliente" => 90.0
            ],
            [
                "indicador_id" => 66,
                "indicadorable_type" => "App\\Models\\Facultad",
                "indicadorable_id" => 8,
                "cod_ind_final" => "IND-077-FCM",
                "minimo" => 50.0,
                "sobresaliente" => 80.0
            ],
            [
                "indicador_id" => 66,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-077-ENF",
                "minimo" => 50.0,
                "sobresaliente" => 80.0
            ],
            [
                "indicador_id" => 66,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-077-OBS",
                "minimo" => 50.0,
                "sobresaliente" => 80.0
            ],
            [
                "indicador_id" => 67,
                "indicadorable_type" => "App\\Models\\Facultad",
                "indicadorable_id" => 8,
                "cod_ind_final" => "IND-078-FCM",
                "minimo" => 70.0,
                "sobresaliente" => 90.0
            ],
            [
                "indicador_id" => 67,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 11,
                "cod_ind_final" => "IND-078-ENF",
                "minimo" => 70.0,
                "sobresaliente" => 90.0
            ],
            [
                "indicador_id" => 67,
                "indicadorable_type" => "App\\Models\\Escuela",
                "indicadorable_id" => 10,
                "cod_ind_final" => "IND-078-OBS",
                "minimo" => 70.0,
                "sobresaliente" => 90.0
            ]
        ];

        \App\Models\Indicadorable::insert($indicadores);
    }
}
