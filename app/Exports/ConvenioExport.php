<?php

namespace App\Exports;

use App\Models\Convalidacion;
use App\Models\Convenio;
use App\Models\Escuela;
use App\Models\Facultad;
use App\Models\Semestre;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ConvenioExport implements FromCollection, WithMapping, WithHeadings, WithStyles
{
    use Exportable;

    private $facultad, $semestre;

    public function __construct($facultad, $semestre)
    {
        $this->facultad = $facultad;
        $this->semestre = $semestre;
    }

    /*
     *  Se hace la consulta a los registros en la BD
     * */
    public function collection()
    {
        $convenios = Convenio::query()
            ->with('semestre', 'facultad');

        if ($this->semestre > 0) {
            $convenios = $convenios->where('semestre_id', $this->semestre);
        }

        if ($this->facultad > 0) {
            $convenios = $convenios->where('facultad_id', $this->facultad);
        }

        $convenios = $convenios->orderBy(Facultad::select('nombre')->whereColumn('facultades.id', 'convenios.facultad_id'))
            ->orderBy(Semestre::select('nombre')->whereColumn('semestres.id', 'convenios.semestre_id'))
            ->get();

        return $convenios;
    }

    /*
     * Recorremos cada registro recuperado en collection()
     * y definimos los registros para cada fila del excel
     * */
    public function map($convenio): array
    {
        return [
            $convenio->semestre->nombre,
            $convenio->realizados,
            $convenio->vigentes,
            $convenio->culminados,
            $convenio->facultad->nombre,
            $convenio->created_at->format('d/m/Y h:i a'),
        ];
    }

    /*
     * Cabeceras y otros registros que iran antes de c/registro de map()
     * */
    public function headings(): array
    {
        return [
            ['Reporte Convenios'],
            ['Facultad', $this->facultad === 0 ? 'Todos' : Facultad::find($this->facultad)->nombre],
            ['Semestre', $this->semestre === 0 ? 'Todos' : Semestre::find($this->semestre)->nombre],
            ['Fecha', now()->format('d/m/Y h:i:s a')],
            ['', ''],
            ['Semestre', 'Realizados', 'Vigentes', 'Culminados', 'Facultad', 'Fecha de Registro']
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
