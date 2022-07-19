<?php

namespace App\Http\Resources;

use App\Company;
use App\Nationality;
use App\Worker;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResoure extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'order_id'=>$this->order_id,
            'worker'=> new WorkerResource(Worker::find($this->worker_id)),
            'company'=> new CopmainsResource(Company::find($this->company_id )),
            'name'=>$this->name,
            'id_number'=>$this->id_number,
            'DOB'=>$this->DOB,
            'phone'=>$this->phone,
            'status'=>booking_status($this->status),
            'visa_number'=>$this->visa_number,
            'visa_image'=>asset('uploads/'.$this->visa_image),
            'created_at'=>$this->created_at->format('Y-m-d')

        ];
    }
  
}
