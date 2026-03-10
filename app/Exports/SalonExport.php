<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class SalonExport implements FromArray, WithEvents, WithDrawings
{

    private $curso;
    private $actividades;
    private $rows;
    private $totalColumns = 0;

    public function __construct($curso, $actividades, $rows)
    {
        $this->curso = $curso;
        $this->actividades = $actividades;
        $this->rows = $rows;
    }

    private function columnLetter(int $index): string
    {
        $letters = '';
        while ($index > 0) {
            $mod = ($index - 1) % 26;
            $letters = chr(65 + $mod) . $letters;
            $index = (int)(($index - $mod) / 26);
        }
        return $letters;
    }

    public function array(): array
    {
        $data = [];

        // TITULOS (como en la plantilla de ejemplo)
        // Dejar espacio para el logo en la esquina superior izquierda
        $data[] = ['', '', 'RESULTADOS DEL ETI 2'];
        $data[] = ['', '', strtoupper($this->curso->materia)];
        $data[] = ['', '', '1ER TRIMESTRE'];
        $data[] = [''];

        // ENCABEZADOS
        $header = ['N°', 'APELLIDOS Y NOMBRES'];

        foreach ($this->actividades as $act) {
            $header[] = strtoupper($act->actividad->actividad);
        }

        $header[] = 'PROMEDIO';
        $header[] = 'MERITO';

        $data[] = $header;

        // Guardamos el total de columnas para el formateo
        $this->totalColumns = count($header);

        // ALUMNOS
        $i = 1;

        foreach ($this->rows as $row) {
            $fila = [
                $i,
                $row['alumno']
            ];

            $notas = array_slice($row, 1);

            foreach ($notas as $n) {
                $fila[] = $n;
            }

            // promedio
            $prom = count($notas) ? array_sum($notas) / count($notas) : 0;
            $fila[] = round($prom, 2);

            // columna de mérito en blanco por defecto
            $fila[] = '';

            $data[] = $fila;
            $i++;
        }

        return $data;
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Logo Next Level School');
        $drawing->setPath(public_path('images/logo_letras3.png'));
        $drawing->setHeight(80);
        $drawing->setCoordinates('A1');
        $drawing->setOffsetX(10);
        $drawing->setOffsetY(5);

        return $drawing;
    }

    public function registerEvents(): array
    {
        return [

            AfterSheet::class => function ($event) {

                $sheet = $event->sheet;
                // ESPACIO PARA EL LOGO
                $sheet->mergeCells('A1:B3');
                $sheet->getColumnDimension('A')->setWidth(5);
                $sheet->getColumnDimension('B')->setWidth(75);

                // Determine last column letter based on headers count
                $lastCol = $this->columnLetter($this->totalColumns);

                // TITULO GRANDE - fila 1 (desde columna C)
                $sheet->mergeCells("C1:{$lastCol}1");
                $sheet->getStyle('C1')->getFont()->setSize(18)->setBold(true);
                $sheet->getStyle('C1')->getAlignment()->setHorizontal('center');

                // Subtítulos (fila 2-3 desde columna C)
                $sheet->mergeCells("C2:{$lastCol}2");
                $sheet->getStyle('C2')->getFont()->setBold(true);
                $sheet->getStyle('C2')->getAlignment()->setHorizontal('center');

                $sheet->mergeCells("C3:{$lastCol}3");
                $sheet->getStyle('C3')->getAlignment()->setHorizontal('center');

                $sheet->mergeCells("A4:{$lastCol}4");
                $sheet->getStyle('A4')->getAlignment()->setHorizontal('center');

                // ENCABEZADOS (fila 5)
                $headerRow = 5;
                $sheet->getStyle("A{$headerRow}:{$lastCol}{$headerRow}")->applyFromArray([
                    'fill' => [
                        'fillType' => 'solid',
                        'startColor' => ['rgb' => 'B7C6D9']
                    ],
                    'font' => [
                        'bold' => true
                    ],
                    'alignment' => [
                        'horizontal' => 'center',
                        'vertical' => 'center',
                        'textRotation' => 90
                    ]
                ]);

                // Las primeras dos columnas (N° y APELLIDOS) sin rotación
                $sheet->getStyle("A{$headerRow}:B{$headerRow}")->applyFromArray([
                    'alignment' => [
                        'horizontal' => 'center',
                        'vertical' => 'center',
                        'textRotation' => 0
                    ]
                ]);

                // Columna PROMEDIO sin rotación
                $promColIndex = $this->totalColumns - 1;
                $promCol = $this->columnLetter($promColIndex);
                $sheet->getStyle("{$promCol}{$headerRow}")->applyFromArray([
                    'alignment' => [
                        'horizontal' => 'center',
                        'vertical' => 'center',
                        'textRotation' => 0
                    ]
                ]);

                // Columna MÉRITO sin rotación
                $meritoCol = $lastCol;
                $sheet->getStyle("{$meritoCol}{$headerRow}")->applyFromArray([
                    'alignment' => [
                        'horizontal' => 'center',
                        'vertical' => 'center',
                        'textRotation' => 0
                    ]
                ]);

                // Aumentar altura de la fila de encabezados para texto vertical
                $sheet->getRowDimension($headerRow)->setRowHeight(100);

                // PROMEDIO (penúltima columna) amarillo
                $promColIndex = $this->totalColumns - 1;
                $promCol = $this->columnLetter($promColIndex);
                $sheet->getStyle("{$promCol}:{$promCol}")->applyFromArray([
                    'fill' => [
                        'fillType' => 'solid',
                        'startColor' => ['rgb' => 'FFFF00']
                    ],
                ]);

                // MÉRITO (última columna) gris claro
                $meritoCol = $lastCol;
                $sheet->getStyle("{$meritoCol}:{$meritoCol}")->applyFromArray([
                    'fill' => [
                        'fillType' => 'solid',
                        'startColor' => ['rgb' => 'D9D9D9']
                    ],
                ]);

                // Ajustar ancho de columnas de actividades (texto vertical)
                for ($i = 3; $i <= $this->totalColumns - 2; $i++) {
                    $col = $this->columnLetter($i);
                    $sheet->getColumnDimension($col)->setWidth(8);
                }

                // Ancho para columnas especiales
                $sheet->getColumnDimension($promCol)->setWidth(12); // PROMEDIO
                $sheet->getColumnDimension($meritoCol)->setWidth(12); // MÉRITO

                // BORDES para toda la tabla
                $sheet->getStyle("A{$headerRow}:{$lastCol}100")->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => 'thin'
                        ]
                    ]
                ]);

                // Ajuste de alto de filas principales
                $sheet->getRowDimension(1)->setRowHeight(30);
                $sheet->getRowDimension(2)->setRowHeight(20);
                $sheet->getRowDimension(3)->setRowHeight(20);
                $sheet->getRowDimension(4)->setRowHeight(10);
            }
        ];
    }
}
