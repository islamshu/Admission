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
        
        return [
          'id'=>$this->id,
          'name'=>$this->name,
          'flag'=>asset('uploads/'.$this->flag),  
          'workers'=>$this->get_worker($request)
          // 'wrokers'=> WorkerResource::collection(
            // Worker::has('company')->get()),
        ];
    }
    function get_worker($request){
        $camp = Worker::query();
        $camp->when($request->nationality_id, function ($q) use ($request) {
            return $q->where('nationality_id', $request->nationality_id);
        });
        $camp->when($request->religion, function ($q) use ($request) {
            return $q->where('religion', $request->religion);
        });
        $camp->when($request->company_id, function ($q) use ($request) {
            return $q->where('company_id', $request->company_id);
        });
        $camp->when($request->is_coocked != null, function ($q) use ($request) {
            return $q->where('is_coocked', $request->is_coocked);
        });
        $camp->when($request->approve_chiled != null, function ($q) use ($request) {
            return $q->where('approve_chiled', $request->approve_chiled);
        });
        $camp->when($request->city != null, function ($q) use ($request) {
            return $q->where('city', $request->city);
        });
        $camp->when($request->age_from != null  || $request->age_to != null, function ($q) use ($request) {
            return $q->whereBetween('age', [$request->age_from, $request->age_to]);
        });
        $camp->when($request->experience_from != null  || $request->experience_to != null, function ($q) use ($request) {
            return $q->whereBetween('experience', [$request->experience_from, $request->experience_to]);
        });
      
        $camp->when($request->admission_period != 0 , function ($q) use ($request) {
            if($request->admission_period_from || $request->admission_period_to){
                return $q->whereBetween('is_quick',[$request->admission_period,$request->admission_period_to]);
            }else{
                return $q->where('is_quick',1);
            }
        });
        $camp->when($request->saudi_experience  != null  || $request->experience_to != null, function ($q) use ($request) {
            return $q->where('in_sa', $request->saudi_experience );
        });
       
        $camp->when($request->name != null, function ($q) use ($request) {
            return $q->where('name','like','%'.$request->name.'%');
        });
        return WorkerResource::collection($camp->get());
    }
}
