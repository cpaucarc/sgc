<?php

namespace App\Exports;

use App\Models\Convalidacion;
use App\Models\Escuela;
use App\Models\Facultad;
use App\Models\Semestre;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ConvalidacionExport implements FromCollection, WithMapping, WithHeadings, WithStyles
{
    use Exportable;

    private $facultad, $escuela, $semestre;

    public function __construct($facultad, $escuela, $semestre)
    {
        $this->facultad = $facultad;
        $this->escuela = $escuela;
        $this->semestre = $semestre;
    }

    /*
     *  Se hace la consulta a los registros en la BD
     * */
    public function collection()
    {
        $convalidaciones = Convalidacion::query()
            ->with('semestre', 'escuela', 'escuela.facultad');

        if ($this->semestre > 0) {
            $convalidaciones = $convalidaciones->where('semestre_id', $this->semestre);
        }

        if ($this->escuela > 0) {
            $convalidaciones = $convalidaciones->where('escuela_id', $this->escuela);
        } else {
            if ($this->facultad > 0) {
                $convalidaciones = $convalidaciones->whereIn('escuela_id', function ($q) {
                    $q->select('id')->from('escuelas')->where('facultad_id', $this->facultad);
                });
            }
        }

        $convalidaciones = $convalidaciones->orderBy(Escuela::select('nombre')->whereColumn('escuelas.id', 'convalidaciones.escuela_id'))
            ->orderBy(Semestre::select('nombre')->whereColumn('semestres.id', 'convalidaciones.semestre_id'))
            ->get();

        return $convalidaciones;
    }

    /*
     * Recorremos cada registro recuperado en collection()
     * y definimos los registros para cada fila del excel
     * */
    public function map($convalidacion): array
    {
        return [
            $convalidacion->semestre->nombre,
            $convalidacion->vacantes,
            $convalidacion->postulantes,
            $convalidacion->convalidados,
            $convalidacion->escuela->nombre,
            $convalidacion->escuela->facultad->nombre,
            $convalidacion->created_at->format('d/m/Y h:i a'),
        ];
    }

    /*
     * Cabeceras y otros registros que iran antes de c/registro de map()
     * */
    public function headings(): array
    {
        return [
            ['Reporte Convalidaciones'],
            ['Facultad', $this->facultad === 0 ? 'Todos' : Facultad::find($this->facultad)->nombre],
            ['Programa de Estudios', $this->escuela === 0 ? 'Todos' : Escuela::find($this->escuela)->nombre],
            ['Semestre', $this->semestre === 0 ? 'Todos' : Semestre::find($this->semestre)->nombre],
            ['Fecha', now()->format('d/m/Y h:i:s a')],
            ['', ''],
            ['Semestre', 'Vacantes', 'Postulantes', 'Convalidados', 'Programa de Estudios', 'Facultad', 'Fecha de Registro']
        ];
    }

    /*
     * Estilos para la hoja de excel
     * */
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1 => ['font' => ['bold' => true, 'size' => 18]], // fila 1: Titulo del reporte
            7 => ['font' => ['bold' => true]], // fila 7: Cabecera de la tabla

            // Styling a specific cell by coordinate.
            'A2' => ['font' => ['bold' => true]],
            'A3' => ['font' => ['bold' => true]],
            'A4' => ['font' => ['bold' => true]],
            'A5' => ['font' => ['bold' => true]],
            'B2' => ['font' => ['italic' => true]],
            'B3' => ['font' => ['italic' => true]],
            'B4' => ['font' => ['italic' => true]],
            'B5' => ['font' => ['italic' => true]],
        ];
    }
}
