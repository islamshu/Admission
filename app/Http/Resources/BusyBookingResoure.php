<?php

namespace App\Http\Resources;

use App\Company;
use App\Nationality;
use App\Worker;
use Illuminate\Http\Resources\Json\JsonResource;

class BusyBookingResoure extends JsonResource
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
            'worker'=> new WorkerResource(Worker::find($this->worker_id)),
            'phone'=>$this->phone,
           

        ];
    }
  
}
