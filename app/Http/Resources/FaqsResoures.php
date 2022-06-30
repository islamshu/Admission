<?php

namespace App\Http\Resources;

use App\About;
use App\Faqs;
use Illuminate\Http\Resources\Json\JsonResource;

class FaqsResoures extends JsonResource
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
            
            
            'title'=> trans('faqs'),
            'content'=> $this->get_data(),
        ];
    }
    

    public function get_data(){
        $lang = request()->header('Lang') == null ? 'ar' : request()->header('Lang')  ;
        $about = Faqs::orderBy('sort', 'asc')->get();
        $array = array();
        if($lang == 'en'){
        foreach($about as $a){
            
            $data['title']= $a->answer_en;
            $data['contnet']= $a->qus_en;
            array_push($array,$data);
        }
        }else{
            foreach($about as $a){
            
                $data['title']= $a->answer_ar;
                $data['contnet']= $a->qus_ar;
                array_push($array,$data);
            }
        }
        return $array;
     
    }
   
}
