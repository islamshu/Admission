<?php

namespace App\Http\Resources;

use App\Worker;
use Illuminate\Http\Resources\Json\JsonResource;

class NatonalityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      dd(Worker::where('nationality_id',$this->id)->get());
        return [
          'id'=>$this->id,
          'name'=>$this->name,
          'flag'=>asset('uploads/'.$this->flag),  
          'wrokers'=>new WorkerResource(Worker::where('nationality_id',$this->id)->get())
        ];
    }
}
