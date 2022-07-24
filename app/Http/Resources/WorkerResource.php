<?php

namespace App\Http\Resources;

use App\Booking;
use App\Nationality;
use App\Worker;
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
            'video'=>$this->video != null ? $this->video : null,
            'natonality'=>new NatonalityResourceWithoutWorker(@$this->natonality),
            'age'=>$this->age,
            'experience'=>$this->experience,
            'experience_in_Sa'=>$this->in_sa == 1 ? 'yes' : 'no',
            'language'=>$this->get_lang($this),
            'religion'=>trans($this->religion),
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
            'external_comapny_name'=>$this->company_name_external,
            'external_comapny_commical_register'=>$this->company_co_register_external,
            'is_able_to_booked'=>$this->check_booked($this),
            'is_booked_from_me'=>$this->check_my_booked($this),
            'visitor'=>$this->visitor_count->count(),
            'compnay'=> new CopmainsResource(@$this->company)

        ];
    }
     function check_booked($data)
    {
        if(auth('client_api')->id() != null){

        
        $last_booking = Booking::where('user_id',auth('client_api')->id())->where('worker_id',$data->id)->orderBy('id', 'DESC')->first();
        $worker = Worker::find($data->id);
        $status=worker_status_id($worker);
        if($last_booking){
        if(($status == 1 || $status==2) && $last_booking->status == 0 ){
            return 1;
        }else{
            return 0;
        }
     }else{
        if($status == 1  || $status==2){
            return 1;
        }else{
            return 0;
        }
     }
    }else{
        return 0;
    }
    }
    function check_my_booked($data)
    {
        if(auth('client_api')->id() != null){

        
        $last_booking = Booking::where('user_id',auth('client_api')->id())->where('worker_id',$data->id)->orderBy('id', 'DESC')->first();

        if($last_booking){
            if($last_booking->status == 1 || $last_booking->status == 2){
                return 1;
            }else{
                return 0;
            }
        }
        }else{
            return 1;
        }
    }
    
    function get_lang($data){
      $langs=  json_decode($data->language);
      $array = array();
      foreach($langs as $a){
        array_push($array,trans($a));
      }
      return $array;

    }
    function get_status($data){
        $status = $data->status;
        if($status ==0){
            $status= 0 ;
        }else{
            
            if($data->is_quick == 1){
                $status= 1;
            }else{
                $status= 2;
            }
        }
        return [
            'id'=>$status ,
            'title'=>worker_status($data),
            'slug'=>slug_worker($data),
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
