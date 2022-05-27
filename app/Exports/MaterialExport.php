<?php

namespace App\Exports;

use App\Models\Facultad;
use App\Models\MaterialBibliografico;
use App\Models\Semestre;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MaterialExport implements FromCollection, WithMapping, WithHeadings, WithStyles
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
        $materiales = MaterialBibliografico::query()
            ->with('semestre', 'facultad');

        if ($this->semestre > 0) {
            $materiales = $materiales->where('semestre_id', $this->semestre);
        }

        if ($this->facultad > 0) {
            $materiales = $materiales->where('facultad_id', $this->facultad);
        }

        $materiales = $materiales->orderBy(Facultad::select('nombre')->whereColumn('facultades.id', 'material_bibliografico.facultad_id'))
            ->orderBy(Semestre::select('nombre')->whereColumn('semestres.id', 'material_bibliografico.semestre_id'))
            ->orderBy('fecha_inicio')
            ->get();

        return $materiales;
    }

    /*
     * Recorremos cada registro recuperado en collection()
     * y definimos los registros para cada fila del excel
     * */
    public function map($material): array
    {
        return [
            $material->semestre->nombre,
            $material->fecha_inicio->format('d/m/Y'),
            $material->fecha_fin->format('d/m/Y'),
            $material->adquirido,
            $material->prestado,
            $material->perdido,
            $material->restaurados,
            $material->total_libros,
            $material->facultad->nombre
        ];
    }

    /*
     * Cabeceras y otros registros que iran antes de c/registro de map()
     * */
    public function headings(): array
    {
        return [
            ['Reporte Material Bibliográfico'],
            ['Facultad', $this->facultad === 0 ? 'Todos' : Facultad::find($this->facultad)->nombre],
            ['Semestre', $this->semestre === 0 ? 'Todos' : Semestre::find($this->semestre)->nombre],
            ['Fecha', now()->format('d/m/Y h:i:s a')],
            ['', ''],
            ['Semestre', 'Fecha de Inicio', 'Fecha de Fin', 'Adquirido', 'Prestado', 'Perdido', 'Restaurado', 'Total de Libros', 'Facultad']
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
