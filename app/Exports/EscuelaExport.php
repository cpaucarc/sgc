<?php

namespace App\Exports;

use App\Models\Auditoria;
use App\Models\Escuela;
use App\Models\Facultad;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EscuelaExport implements FromCollection, WithMapping, WithHeadings, WithStyles
{
    use Exportable;

    private $facultad, $tipo;
    private $auditorias;

    public function __construct($facultad, $tipo)
    {
        $this->facultad = $facultad;
        $this->tipo = $tipo;
    }

    /*
     *  Se hace la consulta a los registros en la BD
     * */
    public function collection()
    {
        return Escuela::query()->with('facultad')
            ->where('facultad_id', $this->facultad)
            ->get();
////        return Escuela::all();
//        return Auditoria::query()->where('facultad_id', $this->facultad);
    }

    /*
     * Recorremos cada registro recuperado en collection()
     * y definimos los registros para cada fila del excel
     * */
    public function map($escuela): array
    {
        return [
            $escuela->uuid,
            $escuela->nombre,
            $escuela->facultad->nombre,
        ];
    }

    /*
     * Cabeceras y otros registros que iran antes de c/registro de map()
     * */
    public function headings(): array
    {
        return [
            ['Reporte Auditorias'],
            ['Facultad', $this->facultad === 0 ? 'Todos' : Facultad::find($this->facultad)->nombre],
            ['Tipo', $this->tipo === -1 ? 'Todos' : ($this->tipo === 0 ? 'Auditoria Externa' : 'Auditoria Interna')],
            ['', ''],
            ['UUID ' . $this->facultad, 'Team Number ' . $this->tipo, 'Date of Birth']
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
            5 => ['font' => ['bold' => true]], // fila 5: Cabecera de la tabla

            // Styling a specific cell by coordinate.
            'A2' => ['font' => ['bold' => true]],
            'A3' => ['font' => ['bold' => true]],
            'B2' => ['font' => ['italic' => true]],
            'B3' => ['font' => ['italic' => true]],

            // Styling an entire column.
//            'C' => ['font' => ['size' => 16]],
        ];
    }

}
