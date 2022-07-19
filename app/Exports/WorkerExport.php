<?php

namespace App\Exports;

use App\Worker;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class WorkerExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
{
    protected $request;

    function __construct($request) {
           $this->request = $request;
    }
    public function collection()
    {
        $worker = Worker::query();
        $worker->when($this->request->status != null,function($q){
            $q->where('status',$this->request->status);
        });
        $worker->when($this->request->nationality_id != null,function($q){
            $q->where('nationality_id',$this->request->nationality_id);
        });
        if(auth()->user()->HasRole('Admin')){
            return $worker->get();
        }else{
            return $worker->where('company_id',auth()->user()->company->id)->get();
        }

    }

   public function headings(): array
    {
        return [
            'اسم العاملة',            
            'اسم مكتب الاستقدام',
            'الجنسية',
            'الحالة',
            'العمر',
            'عدد سنوات الخبرة',
            'هل الخبرات داخل السعودية ام لا?',
            'اللغات',
            'الديانة',
            'هل تتقبل الاطفال?',
            'هل تجيد الطهي ?',
            'المدينة',
            'رابط مساند',

            'صورة العاملة',
            'فيديو للعاملة',
        ];
    }

    /**
    * @var Time $time
    */
    public function map($worker): array
    {
       

        return [
            $worker->name,
            $worker->company->name,
            $worker->natonality->name,
            worker_status($worker),
            $worker->age,
            $worker->experience,
            $worker->in_sa == 1  ?'yes' : 'no',
            $worker->language,
            $worker->religion,
            $worker->approve_chiled == 1  ?'yes' : 'no',
            $worker->is_coocked == 1  ?'yes' : 'no',
            $worker->city,
            $worker->url_sand,
            asset('uploads/'.$worker->image),
            asset('uploads/'.$worker->video),

            
        ];
    }


    

}