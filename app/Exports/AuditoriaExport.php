<?php

namespace App\Exports;

use App\Models\Auditoria;
use App\Models\Escuela;
use App\Models\Facultad;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AuditoriaExport implements FromCollection, WithMapping, WithHeadings, WithStyles
{
    use Exportable;

    private $facultad, $tipo;

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
        $auditorias = Auditoria::query()->withCount('documentos');

        if ($this->facultad > 0) {
            $auditorias = $auditorias->where('facultad_id', $this->facultad);
        }

        if ($this->tipo > -1) {
            $auditorias = $auditorias->where('es_auditoria_interno', $this->tipo);
        }

        $auditorias = $auditorias->orderBy('created_at')->get();

        return $auditorias;
    }

    /*
     * Recorremos cada registro recuperado en collection()
     * y definimos los registros para cada fila del excel
     * */
    public function map($auditoria): array
    {
        return [
            $auditoria->es_auditoria_interno ? 'Auditoria Interna' : 'Auditoria Externa',
            $auditoria->responsable,
            $auditoria->documentos_count,
            $auditoria->created_at->format('d-m-Y h:i a'),
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
            ['Fecha', now()->format('d/m/Y h:i:s a')],
            ['', ''],
            ['Tipo de Auditoria ', 'Responsable', 'Documentos Adjuntos', 'Realización']
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
