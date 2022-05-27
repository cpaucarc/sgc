<?php

namespace App\Exports;

use App\Models\Escuela;
use App\Models\Facultad;
use App\Models\Semestre;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class IndicadorExport implements FromCollection, WithMapping, WithHeadings, WithStyles
{
    use Exportable;

    private $facultad, $escuela, $semestre, $semestre_count;

    public function __construct($facultad, $escuela, $semestre)
    {
        $this->facultad = $facultad;
        $this->escuela = $escuela;
        $this->semestre = $semestre;
        $this->semestre_count = Semestre::query()->count();
    }

    /*
     *  Se hace la consulta a los registros en la BD
     * */
    public function collection()
    {
        if ($this->escuela > 0) {
            $entidad = Escuela::query()->where('id', $this->escuela);
        } else {
            $entidad = Facultad::query()->where('id', $this->facultad);
        }

        $entidad = $entidad->with('indicadores')
            ->with(['indicadores.proceso', 'indicadores.unidadMedida', 'indicadores.medicion', 'indicadores.analisis' => function ($query) {
                if ($this->semestre > 0) {
                    $query->where('semestre_id', $this->semestre);
                }
            }])
            ->first();

        return $entidad->indicadores;
    }

    /*
     * Recorremos cada registro recuperado en collection()
     * y definimos los registros para cada fila del excel
     * */
    public function map($indicador): array
    {
        return [
            $indicador->cod_ind_inicial,
            $indicador->objetivo,
            $indicador->titulo_interes,
            $indicador->titulo_total,
            $indicador->titulo_resultado,
            $indicador->formula,
            $indicador->minimo,
            $indicador->satisfactorio,
            $indicador->sobresaliente,
            $indicador->medicion->nombre,
            $indicador->proceso->nombre,
            $indicador->unidadMedida->nombre,
            count($indicador->analisis) . ' de ' . (6 / $indicador->medicion->tiempo_meses) * $this->semestre_count
        ];
    }

    /*
     * Cabeceras y otros registros que iran antes de c/registro de map()
     * */
    public function headings(): array
    {
        return [
            ['Reporte Indicadores'],
            [($this->escuela === 0 ? 'Facultad' : 'Programa de Estudios'),
                ($this->escuela === 0 ? Facultad::find($this->facultad)->nombre : Escuela::find($this->escuela)->nombre)
            ],
            ['Semestre', $this->semestre === 0 ? 'Todos' : Semestre::find($this->semestre)->nombre],
            ['Fecha', now()->format('d/m/Y h:i:s a')],
            ['', ''],
            ['Código', 'Objetivo', 'Interes', 'Total', 'Resultado', 'Fórmula', 'Mínimo', 'Satisfactorio', 'Sobresaliente', 'Frecuencia de Medición', 'Proceso', 'Unidad de Medida', 'Análisis']
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
        ];
    }
}
