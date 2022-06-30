<?php

namespace App\Http\Resources;

use App\Privacy;
use Illuminate\Http\Resources\Json\JsonResource;

class PrivacyResoures extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'title'=> trans('privacy'),
            'content'=> $this->get_data(),
        ];
    }
    public function get_data(){
        $lang = request()->header('Lang');
        $about = Privacy::orderBy('sort', 'asc')->get();
        $array = array();
        foreach($about as $a){
            
            $data['title']= $a->title_ar;
            $data['contnet']= $a->title_en;
            array_push($array,$data);
        }
        return $array;
     
    }
}
