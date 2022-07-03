<?php

namespace App\Http\Controllers\Api;

use App\About;
use App\Booking;
use App\BusyWorker;
use App\Company;
use App\Contact;
use App\Events\NewBooking;
use App\Faqs;
use App\General;
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
use Doctrine\Inflector\Rules\Word;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\AboutResoures;
use App\Http\Resources\PrivacyResoures;
use App\Http\Resources\SocialResource;
use App\Notifications\NewBookingNotofication;
use App\User;
use Carbon\Carbon;

class HomeController extends BaseController
{
    public function natonality()
    {
        $nats = Nationality::get();
        return NatonalityResource::collection($nats);
    }
    public function compnaines()
    {
        $camp = Company::where('status', 1)->get();
        return CopmainsResource::collection($camp);
    }
    public function company($id)
    {
        $camp = Company::find($id);
        return new CopmainsResource($camp);
    }
    public function workers()
    {
        $camp = $camp = Worker::query()->has('company')->whereHas('company', function ($q) {
            $q->where('status', 1);
        })->get();
        return WorkerResource::collection($camp);
    }
    public function worker($id)
    {
        $camp = Worker::find($id);
        $camp->visitor += 1;
        $camp->save();
        return new WorkerResource($camp);
    }
    public function workers_filter(Request $request)
    {
        $camp = Nationality::query()->has('company')->whereHas('company', function ($q) {
            $q->where('status', 1)->where('deleted_at',null);
        })->has('worker')->whereHas('company', function ($camp) use ($request)  {
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
    });
        $camp = $camp->get();
        dd($camp);
        return WorkerResource::collection($camp);
    }
    public function contact()
    {
        $a= new SocialResource(Social::first());
        return $a;
    }
    public function privacy()
    {
        $a= new PrivacyResoures(Privacy::orderBy('sort', 'asc')->first());
       
        return $a;
    }
    public function abouts()
    {
        // $data['main_title'] = trans('about Us');
        $a=new  AboutResoures(About::orderBy('sort', 'asc')->first());
        // $data['data']= $a;
        return $a;
    }
    public function faqs()
    {
        // $data['main_title'] = trans('faqs');
        // $a= FaqsResoures::collection(Faqs::orderBy('sort', 'asc')->get());
        // $data['data']= $a;
        // return $data;
        $a=new  FaqsResoures(Faqs::orderBy('sort', 'asc')->first());
        // $data['data']= $a;
        return $a;
    }
    public function general()
    {
        $array = array();
// dd(Social::get());
        return [
            'data' => [
                [
                    'title_ar' => get_general_value('title_ar'),
                    'title_en' => get_general_value('title_en'),
                    'logo' => asset('uploads/' . get_general_value('header_logo')),
                    'banner' => asset('uploads/' . get_general_value('icon')),
                    'contacts'=>[
                        'whatsapp'=>@Social::where('type','whatsapp')->first()->value,
                        'phone'=>@Social::where('type','phone')->first()->value,
                        'email'=>@Social::where('type','email')->first()->value,
                    ],
                    'social'=>[
                        'facebook'=>@Social::where('type','facebook')->first()->value,
                        'twitter'=>@Social::where('type','twitter')->first()->value,
                        'Instagram'=>@Social::where('type','Instagram')->first()->value,
                        'YouTube'=>@Social::where('type','YouTube')->first()->value,
                        'website'=>@Social::where('type','Website')->first()->value,
                        'Telegram'=>@Social::where('type','Telegram')->first()->value,
                    ],
                    'natonality'=> NatonalityResource::collection(Nationality::get())
                    
                ]
            ]
        ];
    }
    public function request_worker(Request $request)
    {
        $worker = Worker::find($request->worker_id);
        // return $request;
        if ($worker->status == 1) {

            $booking = new Booking();
            $booking->order_id = Carbon::now()->timestamp;
            $booking->worker_id = $worker->id;
            $booking->company_id = Company::find($worker->company_id)->id;
            $booking->id_number = $request->id_number;
            $booking->name = $request->name;
            $booking->DOB = $request->DOB;
            $booking->phone = $request->phone;
            $booking->visa_image = $request->visa_image->store('booking');
            $booking->save();
            $worker->status = 2;
            $worker->save();
            $data = [
                'id' => $worker->id,
                'name' => $worker->name,
                'url' => route('booking.show', $booking->id),
                'time'=>$booking->created_at
            ];
            // event(new NewBooking($data));
            $admin = User::role('Admin')->first();
            $admin->notify(new NewBookingNotofication($data));
            $user = User::wherehas('company',function($q) use($booking){
                $q->where('id',$booking->company_id);
            })->first();
            $user->notify(new NewBookingNotofication($data));

            return $this->sendResponse(new WorkerResource($worker), trans('Booked successfully'));

        }else{
            $bo = new BusyWorker();
            $worker = Worker::find($request->worker_id);

            $bo->worker_id = $request->worker_id;
            $bo->phone = $request->phone;
            $bo->save();
            $admin = User::role('Admin')->first();
            $data = [
                'id' => $worker->id,
                'name' => $worker->name,
                'url' => route('booking.unavilable.show', $bo->id),
                'time'=>$bo->created_at
            ];
            $admin->notify(new NewBookingNotofication($data));
            $user = User::wherehas('company',function($q) use($worker){
                $q->where('id',$worker->company_id);
            })->first();
            $user->notify(new NewBookingNotofication($data));
            return $this->sendResponse(new WorkerResource($worker), trans('Booked not avaliable now'));

        }
    }
    public function contact_form(Request $request){
        $con = new Contact();
        $con->name = $request->name;
        $con->title = $request->title;
        $con->email = $request->email;
        $con->phone = $request->phone;
        $con->message = $request->message;
        $con->save();
        return $this->sendResponse($con, trans('Message Send'));

    }
    public function search(Request $request){
        $camp = Worker::query()->where('name','like', '%'.$request->key.'%')->has('company')->whereHas('company', function ($q) {
            $q->where('status', 1)->where('deleted_at',null);
        })->get();
       
     
        return WorkerResource::collection($camp);
    }
}
