<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;

use App\Models\ShippingEmail;

class ShippingEmailErrorExport implements FromCollection, WithColumnFormatting, WithHeadings
{

  public function collection()
  {
      return ShippingEmail::join('shippings', 'shipping_emails.shipping_id', '=', 'shippings.id')
                          ->where([['shippings.id', '=' , request()->get('shipping')], ['shipping_emails.status', '=', 'F']])
                          ->select('shipping_emails.id', 'shipping_emails.email', 'shipping_emails.status', 'shipping_emails.error', DB::raw("DATE_FORMAT(shipping_emails.created_at, '%d/%m/%Y')"), 'shippings.title' )
                          ->get();
  }

  public function headings(): array
  {
    return [
      [
        'id',
        'Email',
        'Status',
        'Erro',
        'Data De Envio',
        'Disparo'
      ]
    ];
  }

  public function columnFormats(): array
  {
      return [
          'E' => NumberFormat::FORMAT_DATE_DDMMYYYY,
      ];
  }
}
