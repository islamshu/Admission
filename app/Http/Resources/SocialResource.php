<?php

namespace App\Http\Resources;

use App\Social;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SocialResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
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
        $about = Social::get();
        $array = array();
        foreach($about as $a){
            
            $data['type']= $a->type;
            $data['link']= $a->value;
            array_push($array,$data);
        }
        
        
        return $array;
     
    }
}
