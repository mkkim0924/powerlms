<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ExportReports implements  WithHeadings ,FromArray, ShouldAutoSize, WithColumnFormatting, WithEvents
{
    protected $invoices , $list;

    public function __construct($invoices , $list)
    {
        $this->invoices = $invoices;
        $this->list = $list;
    }

    public function array(): array
    {
        $published_goals = $this->invoices;
        return  $published_goals;
    }

    public function headings(): array
    {
        $fieldArray = $this->list;
        $fieldName = [];
        foreach ($fieldArray as $value)
        {
            $fieldName[] =$value;
        }
        return $fieldName;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }

    public function columnFormats(): array
    {
        return [
            'J' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'K' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'N' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}
