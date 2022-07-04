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
            'video'=>$this->video != null ? asset('uploads/'.$this->video) : null,
            'natonality'=>new NatonalityResourceWithoutWorker(@$this->natonality),
            'age'=>$this->age,
            'experience'=>$this->experience,
            'experience_in_Sa'=>$this->in_sa == 1 ? 'yes' : 'no',
            'language'=>json_decode($this->language),
            'religion'=>$this->religion,
            'approve_chiled'=>$this->approve_chiled,
            'is_coocked'=>$this->is_coocked,
            'is_quick'=>$this->is_quick,
            'city'=>$this->city,
            'descrription'=> $this->get_des($this),
            'time'=>$this->time,
            'url_sand'=>$this->url_sand,
            'status'=>$this->get_status($this),
            'visa_number'=>$this->visa_number,
            
            'worker_status'=>$this->status,
            'visitor'=>$this->visitor_count->count(),
            'compnay'=> new CopmainsResource(@$this->company)

        ];
    }
    function get_status($data){
        return [
            'id'=>$data->status,
            'title'=>worker_status($this->status),
        ];
    }
    function get_des($data){
        $lang = request()->header('Lang');
        if($lang != null){
            if($lang  =='ar'){
                return $data->descrription_ar;
            }else{
                return $data->descrription_en;
  
            }
        }else{
            return $data->descrription_ar;

        }
    }
}
