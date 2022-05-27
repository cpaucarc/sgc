<?php

namespace App\Exports;

use App\Models\Escuela;
use App\Models\Estado;
use App\Models\Facultad;
use App\Models\Investigacion;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class InvestigacionExport implements FromCollection, WithMapping, WithHeadings, WithStyles
{
    use Exportable;

    private $facultad, $escuela, $estado;

    public function __construct($facultad, $escuela, $estado)
    {
        $this->facultad = $facultad;
        $this->escuela = $escuela;
        $this->estado = $estado;
    }

    /*
     *  Se hace la consulta a los registros en la BD
     * */
    public function collection()
    {
        $investigaciones = Investigacion::query()
            ->with('sublinea', 'sublinea.linea', 'sublinea.linea.area', 'escuela', 'escuela.facultad', 'estado', 'financiaciones')
            ->withCount('investigadores');

        if ($this->estado > 0) {
            $investigaciones = $investigaciones->where('estado_id', $this->estado);
        }

        if ($this->escuela > 0) { // hay facultad y escuela
            $investigaciones = $investigaciones->where('escuela_id', $this->escuela);
        } else {
            if ($this->facultad > 0) { // solo hay facultad
                $investigaciones = $investigaciones->whereIn('escuela_id', function ($query) {
                    $query->select('id')->from('escuelas')->where('facultad_id', $this->facultad);
                });
            }
        }

        $investigaciones = $investigaciones
            ->orderBy(Escuela::select('nombre')->whereColumn('escuelas.id', 'investigaciones.escuela_id'))
            ->orderBy(Estado::select('nombre')->whereColumn('estados.id', 'investigaciones.estado_id'))
            ->orderBy('titulo')
            ->get();

        return $investigaciones;
    }

    /*
     * Recorremos cada registro recuperado en collection()
     * y definimos los registros para cada fila del excel
     * */
    public function map($investigacion): array
    {
        return [
            $investigacion->titulo,
            $investigacion->resumen,
            $investigacion->estado->nombre,
            $investigacion->fecha_publicacion ? $investigacion->fecha_publicacion->format('d/m/Y') : 'Sin publicar',
            $investigacion->escuela->nombre,
            $investigacion->escuela->facultad->nombre,
            $investigacion->sublinea->nombre,
            $investigacion->sublinea->linea->nombre,
            $investigacion->sublinea->linea->area->nombre,
            'S/. ' . number_format((float)$investigacion->financiaciones->sum('pivot.presupuesto'), 2),
            $investigacion->investigadores_count > 0 ? $investigacion->investigadores_count : '0',
            $investigacion->created_at->format('d/m/Y h:i a'),
        ];
    }

    /*
     * Cabeceras y otros registros que iran antes de c/registro de map()
     * */
    public function headings(): array
    {
        return [
            ['Reporte Investigaciones'],
            ['Facultad', $this->facultad === 0 ? 'Todos' : Facultad::find($this->facultad)->nombre],
            ['Programa de Estudios', $this->escuela === 0 ? 'Todos' : Escuela::find($this->escuela)->nombre],
            ['Estado', $this->estado === 0 ? 'Todos' : Estado::find($this->estado)->nombre],
            ['Fecha', now()->format('d/m/Y h:i:s a')],
            ['', ''],
            ['Título', 'Resumen', 'Estado', 'Fecha de Publicación', 'Programa de Estudios', 'Facultad', 'Sublínea de Investigación', 'Línea de Investigación', 'Área de Investigación', 'Monto de Financiación', 'N° de Investigadores', 'Fecha de Registro']
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
