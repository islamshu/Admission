<?php

namespace App\Http\Resources;

use App\Nationality;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkerResource extends JsonResource
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
            'name'=>$this->name,
            'image'=>asset('uploads/'.$this->image),
            'natonality'=>new NatonalityResource($this->natonality),
            'age'=>$this->age,
            'experience'=>$this->experience,
            'experience_in_Sa'=>$this->in_sa == 1 ? 'yes' : 'no',
            'language'=>$this->language,
            'religion'=>$this->religion,
            'approve_chiled'=>$this->approve_chiled,
            'is_coocked'=>$this->is_coocked,
            'is_quick'=>$this->is_quick,
            'time'=>$this->time,
            'url_sand'=>$this->url_sand,
            'status'=>worker_status($this->status),
            'visitor'=>$this->visitor,
            'compnay'=> new CopmainsResource($this->company)

        ];
    }
}
