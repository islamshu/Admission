<?php

namespace App\Http\Controllers\Api;

use App\About;
use App\Company;
use App\Faqs;
use App\Http\Controllers\Controller;
use App\Http\Resources\CopmainsResource;
use App\Http\Resources\FaqsResoures;
use App\Http\Resources\NatonalityResource;
use App\Http\Resources\PageResoures;
use App\Http\Resources\SocialCollection;
use App\Http\Resources\WorkerResource;
use App\Nationality;
use App\Privacy;
use App\Social;
use App\Worker;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function natonality(){
       $nats = Nationality::get();
       return NatonalityResource::collection($nats);
    }
    public function compnaines(){
        $camp = Company::where('status',1)->get();
        return CopmainsResource::collection($camp);
    }
    public function company($id){
        $camp = Company::find($id);
        return new CopmainsResource($camp);
    }
    public function workers(){
        $camp = Worker::get();
        return WorkerResource::collection($camp);
    }
    public function worker($id){
        $camp = Worker::find($id);
        return new WorkerResource($camp);
    }
    public function workers_filter(Request $request){
        $camp = Worker::query()->has('company')->whereHas('company',function ($q){
            $q->where('status',1);
        });
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
        $camp=$camp->get();
        return WorkerResource::collection($camp);
    }
    public function contact(){
        $socials = Social::get();
        $res['data'] = new SocialCollection($socials);
        return $res;
    }
    public function privacy(){
        return PageResoures::collection(Privacy::orderBy('sort','asc')->get());
      
    }
    public function abouts(){
        return PageResoures::collection(About::orderBy('sort','asc')->get());

    }
    public function faqs(){
        
        return FaqsResoures::collection(Faqs::orderBy('sort','asc')->get());
    }


    
}
