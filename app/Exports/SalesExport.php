<?php

namespace App\Exports;

use App\Models\Sale;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use Carbon\Carbon;

class SalesExport implements FromCollection, WithHeadings, WithCustomStartCell, WithTitle, WithStyles, WithColumnFormatting, WithMapping, ShouldAutoSize
{
	protected $userId, $dateFrom, $dateTo, $reportType;

	function __construct($userId,$reportType, $f1, $f2){
		$this->userId = $userId;
		$this->reportType = $reportType;
		$this->dateFrom = $f1;
		$this->dateTo = $f2;
		
	}

    public function collection()
    {
        $data = [];

    	if ($this->reportType == 1) { //tipo de reporte seleccionado como <ventas del día>
    		$from = Carbon::parse($this->dateFrom)->format('Y-m-d') . ' 00:00:00';
    		$to = Carbon::parse($this->dateTo)->format('Y-m-d') . ' 23:59:59';
    		
    	}else {
    		$from = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 00:00:00';
    		$to = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 23:59:59';
    	}

    	if ($this->userId == 0) { //Seleccion de todos

    		$data = Sale::join('users as u','u.id','sales.user_id')
    		->select('sales.id','sales.created_at','u.name as user','sales.status','sales.items','sales.total')
    		->whereBetween('sales.created_at',[$from, $to])
    		->get();
    	


    	}else {
    		$data = Sale::join('users as u','u.id','sales.user_id')
    		->select('sales.id','sales.created_at','u.name as user','sales.status','sales.items','sales.total')
    		->whereBetween('sales.created_at',[$from, $to])
    		->where('user_id',$this->userId)
    		->get();
    		
    		
    	}

    	return $data;
    }

    public function headings(): array{
    	return ["FOLIO","FECHA","USUARIO","ESTATUS","ITEMS","IMPORTE"];
    }
    public function startCell(): string{
    	return "A2";
    }
    public function styles(Worksheet $sheet){

    		 $sheet->getStyle(2)->getFont()->setBold(true);
    		// $sheet->setCellValue('F9', '=SUMA(f:f)');
			$sheet->getStyle('A2:F2')
			->getFill()
			->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'D9D9D9'],]);
    		
    	
    }
    public function title(): string{
    	return 'Reportes de ventas';
    }

    public function map($row): array
	    {
	        return [
	        	$row->id,
	           Carbon::parse($row->created_at)->format('d-m-Y h:m A'),
	           $row->user,
	           $row->status,
	           $row->items,
	           $row->total,



	        ];
	    }
	


    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'F' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
        ];
    }
}
