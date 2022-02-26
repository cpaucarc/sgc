<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicion extends Model
{
    // es_escuela (boolean) : Saber si es una Escuela o Facultad
    // entidad_id (integer) : Id de la Escuela o Facultad (depende de si es Escuela o Facultad)
    // fecha_inicio (date) : Rango de inicio de la medición
    // fecha_fin (date) : Rango de finalizacion de la medición (generalmente HOY)

    public static function ind44($es_escuela, $entidad_id, $fecha_inicio, $fecha_fin)
    {
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        $q = Investigador::query()->where('es_docente', true);

        if ($es_escuela) {
            $resultados['interes'] = $q->whereIn('id', function ($query) use ($entidad_id, $fecha_inicio, $fecha_fin) {
                $query->select('investigador_id')
                    ->from('investigacion_investigadores')
                    ->whereIn('investigacion_id', function ($query2) use ($entidad_id, $fecha_inicio, $fecha_fin) {
                        $query2->select('id')->from('investigaciones')
                            ->where('escuela_id', $entidad_id)
                            ->whereBetween('fecha_publicacion', [$fecha_inicio, $fecha_fin]);
                    });
            })->count();

            // FIXME OGE: Calcular el numero total de docentes por escuela desde OGE
            $resultados['total'] = 23; //Enf:23, Obs:21
        } else {
            $resultados['interes'] = $q->whereIn('id', function ($query) use ($entidad_id, $fecha_inicio, $fecha_fin) {
                $query->select('investigador_id')
                    ->from('investigacion_investigadores')
                    ->whereIn('investigacion_id', function ($query2) use ($entidad_id, $fecha_inicio, $fecha_fin) {
                        $query2->select('id')->from('investigaciones')
                            ->whereIn('escuela_id', function ($query3) use ($entidad_id) {
                                $query3->select('id')
                                    ->from('escuelas')
                                    ->where('facultad_id', $entidad_id);
                            })
                            ->whereBetween('fecha_publicacion', [$fecha_inicio, $fecha_fin]);
                    });
            })->count();

            // FIXME OGE: Calcular el numero total de docentes por facultad desde OGE
            $resultados['total'] = 44;
        }
        $resultados['resultado'] = round($resultados['interes'] / $resultados['total'] * 100);
        return $resultados;
    }

    public static function ind45($es_escuela, $entidad_id, $fecha_inicio, $fecha_fin)
    {
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        $q = Investigador::query()->where('es_docente', false);

        if ($es_escuela) {
            $resultados['interes'] = $q->whereIn('id', function ($query) use ($entidad_id, $fecha_inicio, $fecha_fin) {
                $query->select('investigador_id')
                    ->from('investigacion_investigadores')
                    ->whereIn('investigacion_id', function ($query2) use ($entidad_id, $fecha_inicio, $fecha_fin) {
                        $query2->select('id')->from('investigaciones')
                            ->where('escuela_id', $entidad_id)
                            ->whereBetween('fecha_publicacion', [$fecha_inicio, $fecha_fin]);
                    });
            })->count();

            // FIXME OGE: Calcular el numero total de docentes por escuela desde OGE
            $resultados['total'] = 193; //Enf:193, Obs:216
        } else {
            $resultados['interes'] = $q->whereIn('id', function ($query) use ($entidad_id, $fecha_inicio, $fecha_fin) {
                $query->select('investigador_id')
                    ->from('investigacion_investigadores')
                    ->whereIn('investigacion_id', function ($query2) use ($entidad_id, $fecha_inicio, $fecha_fin) {
                        $query2->select('id')->from('investigaciones')
                            ->whereIn('escuela_id', function ($query3) use ($entidad_id) {
                                $query3->select('id')
                                    ->from('escuelas')
                                    ->where('facultad_id', $entidad_id);
                            })
                            ->whereBetween('fecha_publicacion', [$fecha_inicio, $fecha_fin]);
                    });
            })->count();

            // FIXME OGE: Calcular el numero total de docentes por facultad desde OGE
            $resultados['total'] = 409;
        }
        $resultados['resultado'] = round($resultados['interes'] / $resultados['total'] * 100);
        return $resultados;
    }

    public static function ind46($es_escuela, $entidad_id, $fecha_inicio, $fecha_fin)
    {

        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        $q = Investigacion::query()->where('estado_id', 3) //Tabla Estados: 3:Publicado
        ->whereBetween('fecha_publicacion', [$fecha_inicio, $fecha_fin]);

        if ($es_escuela) {
            $resultados['resultado'] = $q->where('escuela_id', $entidad_id)->count();
        } else {
            $resultados['resultado'] = $q->whereIn('escuela_id', function ($query3) use ($entidad_id) {
                $query3->select('id')->from('escuelas')->where('facultad_id', $entidad_id);
            })->count();
        }

        return $resultados;
    }

    public static function ind47($es_escuela, $entidad_id, $fecha_inicio, $fecha_fin)
    {

        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        $q = Investigacion::query()->whereBetween('fecha_publicacion', [$fecha_inicio, $fecha_fin]);

        if ($es_escuela) {
            $resultados['resultado'] = $q->where('escuela_id', $entidad_id)->count();
        } else {
            $resultados['resultado'] = $q->whereIn('escuela_id', function ($query3) use ($entidad_id) {
                $query3->select('id')->from('escuelas')->where('facultad_id', $entidad_id);
            })->count();
        }

        return $resultados;
    }

    public static function ind48($es_escuela, $entidad_id, $fecha_inicio, $fecha_fin)
    {
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        $q = RsuParticipante::query()->where('es_estudiante', true);

        if ($es_escuela) {
            $resultados['resultado'] = $q->whereIn('responsabilidad_social_id', function ($query) use ($entidad_id, $fecha_inicio, $fecha_fin) {
                $query->select('id')->from('responsabilidad_social')
                    ->where('escuela_id', $entidad_id)
                    ->whereBetween('fecha_inicio', [$fecha_inicio, $fecha_fin]);
            })->count();
        } else {
            $resultados['resultado'] = $q->whereIn('responsabilidad_social_id', function ($query) use ($entidad_id, $fecha_inicio, $fecha_fin) {
                $query->select('id')->from('responsabilidad_social')
                    ->whereIn('escuela_id', function ($query2) use ($entidad_id) {
                        $query2->select('id')->from('escuelas')->where('facultad_id', $entidad_id);
                    })
                    ->whereBetween('fecha_inicio', [$fecha_inicio, $fecha_fin]);
            })->count();
        }
        return $resultados;
    }

    public static function ind49($es_escuela, $entidad_id, $fecha_inicio, $fecha_fin)
    {
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        $q = RsuParticipante::query()->where('es_estudiante', false);

        if ($es_escuela) {
            $resultados['resultado'] = $q->whereIn('responsabilidad_social_id', function ($query) use ($entidad_id, $fecha_inicio, $fecha_fin) {
                $query->select('id')->from('responsabilidad_social')
                    ->where('escuela_id', $entidad_id)
                    ->whereBetween('fecha_inicio', [$fecha_inicio, $fecha_fin]);
            })->count();
        } else {
            $resultados['resultado'] = $q->whereIn('responsabilidad_social_id', function ($query) use ($entidad_id, $fecha_inicio, $fecha_fin) {
                $query->select('id')->from('responsabilidad_social')
                    ->whereIn('escuela_id', function ($query2) use ($entidad_id) {
                        $query2->select('id')->from('escuelas')->where('facultad_id', $entidad_id);
                    })
                    ->whereBetween('fecha_inicio', [$fecha_inicio, $fecha_fin]);
            })->count();
        }
        return $resultados;
    }

    public static function ind50($es_escuela, $entidad_id, $fecha_inicio, $fecha_fin)
    {
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        $q = RsuParticipante::query()->where('es_estudiante', false);

        if ($es_escuela) {
            $resultados['interes'] = $q->whereIn('responsabilidad_social_id', function ($query) use ($entidad_id, $fecha_inicio, $fecha_fin) {
                $query->select('id')->from('responsabilidad_social')
                    ->where('escuela_id', $entidad_id)
                    ->whereBetween('fecha_inicio', [$fecha_inicio, $fecha_fin]);
            })->count();

            // FIXME OGE: Calcular el numero total de docentes por escuela desde OGE
            $resultados['total'] = 23; //Enf:23, Obs:21
        } else {
            $resultados['interes'] = $q->whereIn('responsabilidad_social_id', function ($query) use ($entidad_id, $fecha_inicio, $fecha_fin) {
                $query->select('id')->from('responsabilidad_social')
                    ->whereIn('escuela_id', function ($query2) use ($entidad_id) {
                        $query2->select('id')->from('escuelas')->where('facultad_id', $entidad_id);
                    })
                    ->whereBetween('fecha_inicio', [$fecha_inicio, $fecha_fin]);
            })->count();

            // FIXME OGE: Calcular el numero total de docentes por facultad desde OGE
            $resultados['total'] = 44;
        }
        $resultados['resultado'] = round($resultados['interes'] / $resultados['total'] * 100);
        return $resultados;
    }

    public static function ind51($es_escuela, $entidad_id, $fecha_inicio, $fecha_fin)
    {
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        $q = RsuParticipante::query()->where('es_estudiante', true);

        if ($es_escuela) {
            $resultados['interes'] = $q->whereIn('responsabilidad_social_id', function ($query) use ($entidad_id, $fecha_inicio, $fecha_fin) {
                $query->select('id')->from('responsabilidad_social')
                    ->where('escuela_id', $entidad_id)
                    ->whereBetween('fecha_inicio', [$fecha_inicio, $fecha_fin]);
            })->count();
            // FIXME OGE: Calcular el numero total de estudiantes por escuela desde OGE
            $resultados['total'] = 193; //Enf:193, Obs:216
        } else {
            $resultados['interes'] = $q->whereIn('responsabilidad_social_id', function ($query) use ($entidad_id, $fecha_inicio, $fecha_fin) {
                $query->select('id')->from('responsabilidad_social')
                    ->whereIn('escuela_id', function ($query2) use ($entidad_id) {
                        $query2->select('id')->from('escuelas')->where('facultad_id', $entidad_id);
                    })
                    ->whereBetween('fecha_inicio', [$fecha_inicio, $fecha_fin]);
            })->count();
            // FIXME OGE: Calcular el numero total de estudiantes por escuela desde OGE
            $resultados['total'] = 409;
        }
        $resultados['resultado'] = round($resultados['interes'] / $resultados['total'] * 100);
        return $resultados;
    }

    public static function ind52($es_escuela, $entidad_id, $fecha_inicio, $fecha_fin)
    {

        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        $q = ResponsabilidadSocial::query()->whereBetween('fecha_inicio', [$fecha_inicio, $fecha_fin]);

        if ($es_escuela) {
            $resultados['resultado'] = $q->where('escuela_id', $entidad_id)->count();
        } else {
            $resultados['resultado'] = $q->whereIn('escuela_id', function ($query2) use ($entidad_id) {
                $query2->select('id')->from('escuelas')->where('facultad_id', $entidad_id);
            })->count();
        }
        return $resultados;
    }

}
