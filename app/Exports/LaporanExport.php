<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class LaporanExport implements FromView, WithDrawings, ShouldAutoSize
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('laporan.cetak', ['laporan' => $this->data]);
    }

    public function drawings()
    {
        $drawings = [];

        // Loop through your data and add drawings for each image
        foreach ($this->data as $item) {
            for ($i = 1; $i <= 5; $i++) {
                $imageColumn = 'file_' . $i;
                if (!empty($item->$imageColumn)) {
                    $imagePath = public_path('berkas/' . $item->$imageColumn); // Adjust the path as needed
                    $drawing = new Drawing();
                    $drawing->setName('Dokumentasi ' . $i);
                    $drawing->setDescription('Dokumentasi ' . $i);
                    $drawing->setPath($imagePath);
                    $drawing->setHeight(100); // Set the height of the image
                    $drawing->setCoordinates('F' . $item->row); // Set the cell where the image should appear
                    $drawings[] = $drawing;
                }
            }
        }

        return $drawings;
    }
}
