<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CopmainsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
            'id'=>$this->id,
            'name'=>$this->name,
            'image'=>asset('uploads/'.$this->image),
            'longitude'=>$this->longitude,
            'latitude'=>$this->latitude,
            'facebook'=>$this->facebook,
            'twitter'=>$this->twitter,
            'snapchat'=>$this->snapchat,
            'instagram'=>$this->instagram,
            'worker_count'=>$this->workers->count(),

        ];
    }
}
