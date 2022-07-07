<?php

namespace App\Exports;

use App\Booking;
use App\Worker;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class BookingExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
{
    protected $request;

    function __construct($request)
    {
        $this->request = $request;
    }
    public function collection()
    {
        $booking = Booking::query();
        $booking->when($this->request->status != null, function ($q) {
            $q->where('status', $this->request->status);
        });
        $booking->when($this->request->date,function ($q) {
            
            $q->whereBetween('created_at', [$this->request->date .' 00:00:00', $this->request->date .' 23:59:59']);
            });

        if (auth()->user()->HasRole('Admin')) {
            return $booking->get();
        } else {
            return $booking->where('company_id', auth()->user()->company->id)->get();
        }
    }

    public function headings(): array
    {
        return [
            'رقم الطلب',
            'اسم العميل ',
            'اسم العاملة',
            'رقم الهاتف',
            trans('Created at'),
            'تاريخ الميلاد',
            'الحالة',
            'رقم المعرف الخاص بالعميل',
            'رقم الجواز او الاقامة',
            'صورة الفيزا',


        ];
    }
    public function map($booking): array
    {
        return [
            $booking->order_id,
            $booking->name,
            $booking->worker->name,
            $booking->phone,
            $booking->DOB,
            $booking->created_at->format('Y-m-d'),
            booking_status($booking->status),
            $booking->id_number,
            $booking->visa_number,
            asset('uploads/'.$booking->visa_image)
            


        ];
    }
}
