<?php

namespace App\Exports;

use App\Models\Auditoria;
use App\Models\Escuela;
use App\Models\Facultad;
use App\Models\ResponsabilidadSocial;
use App\Models\Semestre;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RsuExport implements FromCollection, WithMapping, WithHeadings, WithStyles
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
        $rsus = ResponsabilidadSocial::query()
            ->with('semestre', 'empresa', 'escuela', 'escuela.facultad')
            ->withCount('participantes');

        if ($this->semestre > 0) {
            $rsus = $rsus->where('semestre_id', $this->semestre);
        }

        if ($this->escuela > 0) { // hay facultad y escuela
            $rsus = $rsus->where('escuela_id', $this->escuela);
        } else {
            if ($this->facultad > 0) { // solo hay facultad
                $rsus = $rsus->whereIn('escuela_id', function ($query) {
                    $query->select('id')->from('escuelas')->where('facultad_id', $this->facultad);
                });
            }
        }

        $rsus = $rsus
            ->orderBy(Escuela::select('nombre')->whereColumn('escuelas.id', 'responsabilidad_social.escuela_id'))
            ->orderBy(Semestre::select('nombre')->whereColumn('semestres.id', 'responsabilidad_social.semestre_id'))
            ->orderBy('titulo')
            ->get();

        return $rsus;
    }

    /*
     * Recorremos cada registro recuperado en collection()
     * y definimos los registros para cada fila del excel
     * */
    public function map($rsu): array
    {
        return [
            $rsu->titulo,
            $rsu->descripcion,
            $rsu->semestre->nombre,
            $rsu->escuela->nombre,
            $rsu->escuela->facultad->nombre,
            $rsu->participantes_count > 0 ? $rsu->participantes_count : '0',
            $rsu->lugar,
            $rsu->empresa ? $rsu->empresa->nombre : 'Ninguno',
            $rsu->fecha_inicio->format('d/m/Y'),
            $rsu->fecha_fin->format('d/m/Y'),
            $rsu->created_at->format('d/m/Y h:i a'),
        ];
    }

    /*
     * Cabeceras y otros registros que iran antes de c/registro de map()
     * */
    public function headings(): array
    {
        return [
            ['Reporte Responsabilidad Social'],
            ['Facultad', $this->facultad === 0 ? 'Todos' : Facultad::find($this->facultad)->nombre],
            ['Escuela', $this->escuela === 0 ? 'Todos' : Escuela::find($this->escuela)->nombre],
            ['Semestre', $this->semestre === 0 ? 'Todos' : Semestre::find($this->semestre)->nombre],
            ['', ''],
            ['Título', 'Descripción', 'Semestre', 'Escuela', 'Facultad', 'Participantes', 'Lugar', 'Empresa', 'Fecha de Inicio', 'Fecha de Fin', 'Fecha de Registro']
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
            6 => ['font' => ['bold' => true]], // fila 6: Cabecera de la tabla

            // Styling a specific cell by coordinate.
            'A2' => ['font' => ['bold' => true]],
            'A3' => ['font' => ['bold' => true]],
            'A4' => ['font' => ['bold' => true]],
            'B2' => ['font' => ['italic' => true]],
            'B3' => ['font' => ['italic' => true]],
            'B4' => ['font' => ['italic' => true]],

            // Styling an entire column.
//            'C' => ['font' => ['size' => 16]],
        ];
    }
}
