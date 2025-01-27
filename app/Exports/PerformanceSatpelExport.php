<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PerformanceSatpelExport implements FromView, WithStyles
{
    protected $variable;
    /**
     * @param mixed $variable
     */
    public function __construct($variable)
    {
        $this->variable = $variable;
    }

    public function view(): View
    {
        return view('admin.report.performance-satpel.excel', $this->variable);
    }

    public function styles(Worksheet $sheet)
    {
        // Calculate the range dynamically
        $highestRow = $sheet->getHighestRow(); // Automatically detect the last row with data
        $range = "A7:L{$highestRow}"; // Covers A to L from row 7 to the last row dynamically

        // Apply borders to the dynamic range
        $sheet->getStyle($range)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'], // Black color
                ],
            ],
        ]);

        // Optionally style the header rows (row 7 to 9 in your case)
        $sheet->getStyle('A7:L9')->applyFromArray([
            'font' => [
                'bold' => true, // Make header text bold
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFFFE0B2'], // Light orange background
            ],
        ]);

        return $sheet;
    }
}
