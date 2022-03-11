<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicion extends Model
{
    /*
    > es_escuela (boolean) : Saber si es una Escuela o Facultad
    > entidad_id (integer) : Id de la Escuela o Facultad (depende de si es Escuela o Facultad)
    > fecha_inicio (date) : Rango de inicio de la medición
    > fecha_fin (date) : Rango de finalizacion de la medición (generalmente HOY)
    */

    public static function ind09($facultad_id, $fecha_inicio, $fecha_fin)
    {
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        $resultados['resultado'] = MaterialBibliografico::query()
            ->where('facultad_id', $facultad_id)
            ->where(function ($query) use ($fecha_inicio, $fecha_fin) {
                $query->where(function ($q1) use ($fecha_inicio, $fecha_fin) {
                    $q1->whereBetween('fecha_inicio', [$fecha_inicio, $fecha_fin])
                        ->whereBetween('fecha_fin', [$fecha_inicio, $fecha_fin]);
                })
                    ->orWhere(function ($q2) use ($fecha_inicio, $fecha_fin) {
                        $q2->where('fecha_inicio', '>', $fecha_inicio)
                            ->whereBetween('fecha_fin', [$fecha_inicio, $fecha_fin]);
                    })
                    ->orWhere(function ($q2) use ($fecha_inicio, $fecha_fin) {
                        $q2->where('fecha_fin', '<', $fecha_fin)
                            ->whereBetween('fecha_inicio', [$fecha_inicio, $fecha_fin]);
                    });
            })
            ->sum('adquirido');

        $resultados['resultado'] = is_null($resultados['resultado']) ? 0 : $resultados['resultado'];

        return $resultados;
    }

    public static function ind10($facultad_id, $fecha_inicio, $fecha_fin)
    {
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        $resultados['resultado'] = MaterialBibliografico::query()
            ->where('facultad_id', $facultad_id)
            ->where(function ($query) use ($fecha_inicio, $fecha_fin) {
                $query->where(function ($q1) use ($fecha_inicio, $fecha_fin) {
                    $q1->whereBetween('fecha_inicio', [$fecha_inicio, $fecha_fin])
                        ->whereBetween('fecha_fin', [$fecha_inicio, $fecha_fin]);
                })
                    ->orWhere(function ($q2) use ($fecha_inicio, $fecha_fin) {
                        $q2->where('fecha_inicio', '>', $fecha_inicio)
                            ->whereBetween('fecha_fin', [$fecha_inicio, $fecha_fin]);
                    })
                    ->orWhere(function ($q2) use ($fecha_inicio, $fecha_fin) {
                        $q2->where('fecha_fin', '<', $fecha_fin)
                            ->whereBetween('fecha_inicio', [$fecha_inicio, $fecha_fin]);
                    });
            })
            ->sum('prestado');

        $resultados['resultado'] = is_null($resultados['resultado']) ? 0 : $resultados['resultado'];

        return $resultados;
    }

    public static function ind11($facultad_id, $fecha_inicio, $fecha_fin)
    {
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        $resultados['resultado'] = MaterialBibliografico::query()
            ->where('facultad_id', $facultad_id)
            ->where(function ($query) use ($fecha_inicio, $fecha_fin) {
                $query->where(function ($q1) use ($fecha_inicio, $fecha_fin) {
                    $q1->whereBetween('fecha_inicio', [$fecha_inicio, $fecha_fin])
                        ->whereBetween('fecha_fin', [$fecha_inicio, $fecha_fin]);
                })
                    ->orWhere(function ($q2) use ($fecha_inicio, $fecha_fin) {
                        $q2->where('fecha_inicio', '>', $fecha_inicio)
                            ->whereBetween('fecha_fin', [$fecha_inicio, $fecha_fin]);
                    })
                    ->orWhere(function ($q2) use ($fecha_inicio, $fecha_fin) {
                        $q2->where('fecha_fin', '<', $fecha_fin)
                            ->whereBetween('fecha_inicio', [$fecha_inicio, $fecha_fin]);
                    });
            })
            ->sum('perdido');

        $resultados['resultado'] = is_null($resultados['resultado']) ? 0 : $resultados['resultado'];

        return $resultados;
    }

    public static function ind12($escuela_id, $fecha_inicio, $fecha_fin)
    {
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        $resultados['resultado'] = BibliotecaVisitante::query()
            ->where('escuela_id', $escuela_id)
            ->where(function ($query) use ($fecha_inicio, $fecha_fin) {
                $query->where(function ($q1) use ($fecha_inicio, $fecha_fin) {
                    $q1->whereBetween('fecha_inicio', [$fecha_inicio, $fecha_fin])
                        ->whereBetween('fecha_fin', [$fecha_inicio, $fecha_fin]);
                })
                    ->orWhere(function ($q2) use ($fecha_inicio, $fecha_fin) {
                        $q2->where('fecha_inicio', '>', $fecha_inicio)
                            ->whereBetween('fecha_fin', [$fecha_inicio, $fecha_fin]);
                    })
                    ->orWhere(function ($q2) use ($fecha_inicio, $fecha_fin) {
                        $q2->where('fecha_fin', '<', $fecha_fin)
                            ->whereBetween('fecha_inicio', [$fecha_inicio, $fecha_fin]);
                    });
            })
            ->sum('visitantes');

        $resultados['resultado'] = is_null($resultados['resultado']) ? 0 : $resultados['resultado'];

        return $resultados;
    }

    public static function ind13($facultad_id, $fecha_inicio, $fecha_fin)
    {
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        $my_query = MaterialBibliografico::query()
            ->where('facultad_id', $facultad_id)
            ->where(function ($query) use ($fecha_inicio, $fecha_fin) {
                $query->where(function ($q1) use ($fecha_inicio, $fecha_fin) {
                    $q1->whereBetween('fecha_inicio', [$fecha_inicio, $fecha_fin])
                        ->whereBetween('fecha_fin', [$fecha_inicio, $fecha_fin]);
                })
                    ->orWhere(function ($q2) use ($fecha_inicio, $fecha_fin) {
                        $q2->where('fecha_inicio', '>', $fecha_inicio)
                            ->whereBetween('fecha_fin', [$fecha_inicio, $fecha_fin]);
                    })
                    ->orWhere(function ($q2) use ($fecha_inicio, $fecha_fin) {
                        $q2->where('fecha_fin', '<', $fecha_fin)
                            ->whereBetween('fecha_inicio', [$fecha_inicio, $fecha_fin]);
                    });
            });

        $resultados['interes'] = $my_query->sum('adquirido');
        $resultados['total'] = $my_query->max('total_libros');

        $resultados['resultado'] = is_null($resultados['interes']) ? 0
            : (is_null($resultados['total']) ? 0 : round($resultados['interes'] / $resultados['total'] * 100));

        return $resultados;
    }

    public static function ind14($facultad_id, $fecha_inicio, $fecha_fin)
    {
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        $resultados['resultado'] = MaterialBibliografico::query()
            ->where('facultad_id', $facultad_id)
            ->where(function ($query) use ($fecha_inicio, $fecha_fin) {
                $query->where(function ($q1) use ($fecha_inicio, $fecha_fin) {
                    $q1->whereBetween('fecha_inicio', [$fecha_inicio, $fecha_fin])
                        ->whereBetween('fecha_fin', [$fecha_inicio, $fecha_fin]);
                })
                    ->orWhere(function ($q2) use ($fecha_inicio, $fecha_fin) {
                        $q2->where('fecha_inicio', '>', $fecha_inicio)
                            ->whereBetween('fecha_fin', [$fecha_inicio, $fecha_fin]);
                    })
                    ->orWhere(function ($q2) use ($fecha_inicio, $fecha_fin) {
                        $q2->where('fecha_fin', '<', $fecha_fin)
                            ->whereBetween('fecha_inicio', [$fecha_inicio, $fecha_fin]);
                    });
            })
            ->sum('restaurados');

        $resultados['resultado'] = is_null($resultados['resultado']) ? 0 : $resultados['resultado'];

        return $resultados;
    }

    public static function ind24($escuela_id, $fecha_inicio, $fecha_fin)
    {
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        $cantidad = Convalidacion::query()->where('escuela_id', $escuela_id)
            ->whereBetween('created_at', [$fecha_inicio, $fecha_fin])
            ->sum('convalidados');

        $resultados['resultado'] = $cantidad ?? 0;
        return $resultados;
    }

    public static function ind25($escuela_id, $fecha_inicio, $fecha_fin)
    {
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        $cantidad = Convalidacion::query()->where('escuela_id', $escuela_id)
            ->whereBetween('created_at', [$fecha_inicio, $fecha_fin])
            ->sum('vacantes');

        $resultados['resultado'] = $cantidad ?? 0;
        return $resultados;
    }

    public static function ind26($escuela_id, $fecha_inicio, $fecha_fin)
    {
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        $cantidad = Convalidacion::query()->where('escuela_id', $escuela_id)
            ->whereBetween('created_at', [$fecha_inicio, $fecha_fin])
            ->sum('postulantes');

        $resultados['resultado'] = $cantidad ?? 0;
        return $resultados;
    }

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

    public static function ind58($es_escuela, $entidad_id, $fecha_inicio, $fecha_fin)
    {
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        $q = GradoEstudiante::query()->where('grado_academico_id', 2)
            ->whereBetween('created_at', [$fecha_inicio, $fecha_fin]);

        if ($es_escuela) {
            $escuelas = Escuela::select('id')->where('id', $entidad_id)->get();
        } else {
            $escuelas = Escuela::select('id')->where('facultad_id', $entidad_id)->get();
        }

        $q = $q->whereIn('escuela_id', $escuelas);

        $resultados['interes'] = GradoEstudiante::query()->where('grado_academico_id', 3)
            ->whereIn('escuela_id', $escuelas)
            ->where(function ($query) use ($fecha_inicio, $fecha_fin, $q) {
                $query->whereBetween('created_at', [$fecha_inicio, $fecha_fin])
                    ->orWhereIn('codigo_estudiante', $q->select('codigo_estudiante')->get());
            })->count();

        $resultados['total'] = $q->count();

        $resultados['resultado'] = $resultados['interes'] == 0 ? 0 : round($resultados['interes'] / $resultados['total'] * 100);
        return $resultados;
    }

    public static function ind59($es_escuela, $entidad_id, $fecha_inicio, $fecha_fin)
    {
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        $q = GradoEstudiante::query()->where('grado_academico_id', 3)
            ->whereBetween('created_at', [$fecha_inicio, $fecha_fin]);

        if ($es_escuela) {
            $escuelas = Escuela::select('id')->where('id', $entidad_id)->get();
        } else {
            $escuelas = Escuela::select('id')->where('facultad_id', $entidad_id)->get();
        }

        $q = $q->whereIn('escuela_id', $escuelas);

        $resultados['interes'] = GradoEstudiante::query()->where('grado_academico_id', 4)
            ->whereIn('escuela_id', $escuelas)
            ->where(function ($query) use ($fecha_inicio, $fecha_fin, $q) {
                $query->whereBetween('created_at', [$fecha_inicio, $fecha_fin])
                    ->orWhereIn('codigo_estudiante', $q->select('codigo_estudiante')->get());
            })->count();

        $resultados['total'] = $q->count();

        $resultados['resultado'] = $resultados['interes'] == 0 ? 0 : round($resultados['interes'] / $resultados['total'] * 100);
        return $resultados;
    }

    public static function ind60($es_escuela, $entidad_id, $fecha_inicio, $fecha_fin)
    {
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        $q = GradoEstudiante::query()->where('grado_academico_id', 4)
            ->whereBetween('created_at', [$fecha_inicio, $fecha_fin]);

        if ($es_escuela) {
            $q = $q->where('escuela_id', $entidad_id);
        } else {
            $q = $q->whereIn('escuela_id', function ($query2) use ($entidad_id) {
                $query2->select('id')->from('escuelas')->where('facultad_id', $entidad_id);
            });
        }

        $resultados['resultado'] = $q->count();

        return $resultados;
    }

    public static function ind61($es_escuela, $entidad_id, $fecha_inicio, $fecha_fin)
    {
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        if ($es_escuela) {
            $escuelas = Escuela::select('id')->where('id', $entidad_id)->get();
        } else {
            $escuelas = Escuela::select('id')->where('facultad_id', $entidad_id)->get();
        }

        $resultados['total'] = Tesis::query()->whereIn('escuela_id', $escuelas)
            ->whereIn('id', function ($query) use ($fecha_inicio, $fecha_fin) {
                return $query->select('tesis_id')->from('sustentaciones')
                    ->whereBetween('fecha_sustentacion', [$fecha_inicio, $fecha_fin]);
            })->count();

        $resultados['interes'] = Tesis::query()->whereIn('escuela_id', $escuelas)
            ->whereIn('id', function ($query) use ($fecha_inicio, $fecha_fin) {
                return $query->select('tesis_id')->from('sustentaciones')
                    ->where('estado_id', 10)
                    ->whereBetween('fecha_sustentacion', [$fecha_inicio, $fecha_fin]);
            })->count();

        $resultados['resultado'] = $resultados['interes'] == 0 ? 0 : round($resultados['interes'] / $resultados['total'] * 100);
        return $resultados;
    }

    public static function ind01($facultad_id, $fecha_inicio, $fecha_fin)
    {
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        $callback = function ($query) use ($facultad_id) {
            $query->select('id')->from('responsables')
                ->whereIn('actividad_id', function ($query) {
                    $query->select('id')->from('actividades')->whereIn('tipo_actividad_id', [1, 2]);
                })
                ->whereIn('entidad_id', function ($query2) use ($facultad_id) {
                    $query2->select('entidad_id')->from('entidadables')
                        ->where(function ($query2) use ($facultad_id) {
                            $query2->where('entidadable_type', "App\\Models\\Facultad")->where('entidadable_id', $facultad_id);
                        })
                        ->orWhere(function ($query3) use ($facultad_id) {
                            $query3->where('entidadable_type', "App\\Models\\Escuela")
                                ->whereIn('entidadable_id', function ($q3) use ($facultad_id) {
                                    $q3->select('id')->from('escuelas')->where('facultad_id', $facultad_id);
                                });
                        });
                });
        };

        $q = ActividadCompletado::query()->whereBetween('created_at', [$fecha_inicio, $fecha_fin]);

        $resultados['total'] = Responsable::query()->whereIn('id', $callback)->count();

        $resultados['interes'] = $q->whereIn('responsable_id', $callback)->count();

        $resultados['resultado'] = $resultados['interes'] == 0 ? 0 : round($resultados['interes'] / $resultados['total'] * 100);
        return $resultados;
    }

    public static function ind68($facultad_id, $fecha_inicio, $fecha_fin)
    {
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        $q = AnalisisIndicador::query()
            ->where('cod_ind_final', 'not like', '%68%')
            ->whereDate('fecha_medicion_inicio', '>=', $fecha_inicio)
            ->whereDate('fecha_medicion_fin', '<=', $fecha_fin)
            ->whereIn('indicadorable_id', function ($query) use ($facultad_id) {
                $query->select('id')->from('indicadorables')
                    ->where(function ($query2) use ($facultad_id) {
                        $query2->where('indicadorable_type', "App\\Models\\Facultad")->where('indicadorable_id', $facultad_id);
                    })
                    ->orWhere(function ($query3) use ($facultad_id) {
                        $query3->where('indicadorable_type', "App\\Models\\Escuela")
                            ->whereIn('indicadorable_id', function ($q3) use ($facultad_id) {
                                $q3->select('id')->from('escuelas')->where('facultad_id', $facultad_id);
                            });
                    });
            });

        $resultados['total'] = $q->count();

        $resultados['interes'] = $q->whereColumn('resultado', '<=', 'minimo')->count();

        $resultados['resultado'] = $resultados['interes'] == 0 ? 0 : round($resultados['interes'] / $resultados['total'] * 100);
        return $resultados;
    }

    public static function ind70($facultad_id, $fecha_inicio, $fecha_fin)
    {
        $resultados = array('interes' => null, 'total' => null, 'resultado' => null);

        $callback = function ($query) use ($facultad_id) {
            $query->select('id')->from('responsables')
                ->whereIn('actividad_id', function ($query) {
                    $query->select('id')->from('actividades')->whereIn('tipo_actividad_id', [4]);
                })
                ->whereIn('entidad_id', function ($query2) use ($facultad_id) {
                    $query2->select('entidad_id')->from('entidadables')
                        ->where(function ($query2) use ($facultad_id) {
                            $query2->where('entidadable_type', "App\\Models\\Facultad")->where('entidadable_id', $facultad_id);
                        })
                        ->orWhere(function ($query3) use ($facultad_id) {
                            $query3->where('entidadable_type', "App\\Models\\Escuela")
                                ->whereIn('entidadable_id', function ($q3) use ($facultad_id) {
                                    $q3->select('id')->from('escuelas')->where('facultad_id', $facultad_id);
                                });
                        });
                });
        };

        $q = ActividadCompletado::query()->whereBetween('created_at', [$fecha_inicio, $fecha_fin]);

        $resultados['total'] = Responsable::query()->whereIn('id', $callback)->count();

        $resultados['interes'] = $q->whereIn('responsable_id', $callback)->count();

        $resultados['resultado'] = $resultados['interes'] == 0 ? 0 : round($resultados['interes'] / $resultados['total'] * 100);
        return $resultados;
    }
}
