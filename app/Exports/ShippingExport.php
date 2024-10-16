<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;

use App\Models\Shipping;

class ShippingExport implements FromCollection, WithColumnFormatting, WithHeadings
{

  public function collection()
  {
    if(!request()->filled('data_inicial') && !request()->filled('data_final')) {
      return Shipping::select('id', 'title', 'html', 'status', 'shipping_date', DB::raw("DATE_FORMAT(created_at, '%d/%m/%Y')"))->get();
    }
    else if(!request()->filled('data_inicial') || !request()->filled('data_final')) {

      if (!request()->filled('data_inicial') && request()->filled('data_final')) {
        return Shipping::select('id', 'title', 'html', 'status', 'shipping_date', DB::raw("DATE_FORMAT(created_at, '%d/%m/%Y')") )
                 ->where('created_at', '<=', request()->get('data_final').' 23:59:59')->get();
      }
      else {
        return Shipping::select('id', 'title', 'html', 'status', 'shipping_date', DB::raw("DATE_FORMAT(created_at, '%d/%m/%Y')") )
        ->where('created_at', '>=', request()->get('data_inicial').' 00:00:00')->get();
      }

    }
    else {
      return Shipping::select('id', 'title', 'html', 'status', 'shipping_date', DB::raw("DATE_FORMAT(created_at, '%d/%m/%Y')") )
                 ->whereBetween('created_at', [request()->get('data_inicial').' 00:00:00', request()->get('data_final').' 23:59:59'])->get();
    }
  }

  public function headings(): array
  {
    return [
      [
        'id',
        'Titulo',
        'HTML',
        'Status',
        'Data De Envio',
        'Data De Criação/Atualização'
      ]
    ];
  }

  public function columnFormats(): array
  {
      return [
          'D' => NumberFormat::FORMAT_DATE_DDMMYYYY,
          'E' => NumberFormat::FORMAT_DATE_DDMMYYYY
      ];
  }
}
