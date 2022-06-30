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
        $lang = request()->header('Lang') == null ? 'ar' : request()->header('Lang')  ;
        $about = Privacy::orderBy('sort', 'asc')->get();
        $array = array();
        if($lang == 'en'){
            foreach($about as $a){
            
                $data['title']= $a->title_en;
                $data['contnet']= $a->body_en;
                array_push($array,$data);
            }
        }else{
            foreach($about as $a){
            $data['title']= $a->title_ar;
            $data['contnet']= $a->body_ar;
            array_push($array,$data);
        }
        }
        
        return $array;
     
    }
}
