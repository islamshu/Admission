<?php

namespace App\Http\Controllers\Api;

use App\About;
use App\Booking;
use App\BusyWorker;
use App\Company;
use App\Events\NewBooking;
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
use Doctrine\Inflector\Rules\Word;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Notifications\NewBookingNotofication;
use App\User;

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
        $camp = Worker::get();
        return WorkerResource::collection($camp);
    }
    public function worker($id)
    {
        $camp = Worker::find($id);
        return new WorkerResource($camp);
    }
    public function workers_filter(Request $request)
    {
        $camp = Worker::query()->has('company')->whereHas('company', function ($q) {
            $q->where('status', 1);
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
        $camp = $camp->get();
        return WorkerResource::collection($camp);
    }
    public function contact()
    {
        $socials = Social::get();
        $res['data'] = new SocialCollection($socials);
        return $res;
    }
    public function privacy()
    {
        return PageResoures::collection(Privacy::orderBy('sort', 'asc')->get());
    }
    public function abouts()
    {
        return PageResoures::collection(About::orderBy('sort', 'asc')->get());
    }
    public function faqs()
    {
        return FaqsResoures::collection(Faqs::orderBy('sort', 'asc')->get());
    }
    public function general()
    {
        $array = array();
        return [
            'data' => [
                [
                    'title_ar' => get_general_value('title_ar'),
                    'title_en' => get_general_value('title_en'),
                    'logo' => asset('uploads/' . get_general_value('header_logo')),
                    'icon' => asset('uploads/' . get_general_value('icon'))
                ]
            ]
        ];
    }
    public function request_worker(Request $request)
    {
        $worker = Worker::find($request->worker_id);
        if ($worker->status == 1) {
            $booking = new Booking();
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
            $bo->worker_id = $request->worker_id;
            $bo->phone = $request->phone;
            $bo->save();
            return $this->sendResponse(new WorkerResource($worker), trans('Booked not avaliable now'));

        }
    }
}
