<?php

namespace App\Exports;

use App\Models\BienestarAtencion;
use App\Models\Comedor;
use App\Models\Escuela;
use App\Models\Facultad;
use App\Models\Servicio;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BienestarExport implements FromCollection, WithMapping, WithHeadings, WithStyles
{
    use Exportable;

    private $facultad, $escuela, $anio;
    private $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

    public function __construct($facultad, $escuela, $anio)
    {
        $this->facultad = $facultad;
        $this->escuela = $escuela;
        $this->anio = $anio;
    }

    /*
     *  Se hace la consulta a los registros en la BD
     * */
    public function collection()
    {
        $atenciones = BienestarAtencion::query()
            ->with('escuela', 'escuela.facultad', 'servicio');

        if ($this->anio > 0) {
            $atenciones = $atenciones->where('anio', $this->anio);
        }

        if ($this->escuela > 0) {
            $atenciones = $atenciones->where('escuela_id', $this->escuela);
        } else {
            if ($this->facultad > 0) {
                $atenciones = $atenciones->whereIn('escuela_id', function ($q) {
                    $q->select('id')->from('escuelas')->where('facultad_id', $this->facultad);
                });
            }
        }

        $atenciones = $atenciones->orderBy(Escuela::select('nombre')->whereColumn('escuelas.id', 'bienestar_atenciones.escuela_id'))
            ->orderBy('anio')
            ->orderBy('mes')
            ->orderBy(Servicio::select('nombre')->whereColumn('servicios.id', 'bienestar_atenciones.servicio_id'))
            ->get();

        return $atenciones;
    }

    /*
     * Recorremos cada registro recuperado en collection()
     * y definimos los registros para cada fila del excel
     * */
    public function map($atencion): array
    {
        return [
            $atencion->servicio->nombre,
            $this->meses[$atencion->mes - 1],
            $atencion->anio,
            $atencion->atenciones ? $atencion->atenciones : '0',
            $atencion->escuela->nombre,
            $atencion->escuela->facultad->nombre
        ];
    }

    /*
     * Cabeceras y otros registros que iran antes de c/registro de map()
     * */
    public function headings(): array
    {
        return [
            ['Reporte Comedor Universitario'],
            ['Facultad', $this->facultad === 0 ? 'Todos' : Facultad::find($this->facultad)->nombre],
            ['Programa de Estudios', $this->escuela === 0 ? 'Todos' : Escuela::find($this->escuela)->nombre],
            ['Año', $this->anio === 0 ? 'Todos' : $this->anio],
            ['Fecha', now()->format('d/m/Y h:i:s a')],
            ['', ''],
            ['Servicio', 'Mes', 'Año', 'Atenciones', 'Programa de Estudios', 'Facultad']
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
