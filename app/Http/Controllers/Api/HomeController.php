<?php

namespace App\Http\Controllers\Api;

use App\About;
use App\Booking;
use App\BusyWorker;
use App\Client;
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
use App\Http\Controllers\NationalityController;
use App\Http\Resources\AboutResoures;
use App\Http\Resources\BookingResoure;
use App\Http\Resources\BusyBookingResoure;
use App\Http\Resources\PrivacyResoures;
use App\Http\Resources\SocialResource;
use App\Notifications\NewBookingNotofication;
use App\User;
use App\Vistor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
class HomeController extends BaseController
{
    public function natonality()
    {
        $nats = Nationality::has('worker')->get();
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
        $camp = Worker::query()->where('is_show',1)->has('company')->whereHas('company', function ($q) {
            $q->where('status', 1);
        })->get();
        return WorkerResource::collection($camp);
    }
    public function worker($id)
    {
        $camp = Worker::find($id);
        $vistor = new Vistor();
        $vistor->worker_id = $id;
        $vistor->company_id = $camp->company_id;
        $vistor->save();
    
        return new WorkerResource($camp);
    }
    public function workers_filter(Request $request)
    {
        $camp = Nationality::query()->has('worker')->whereHas('worker', function ($camp) use ($request)  {
            $camp->where('is_show',1);
           $camp->has('company')->whereHas('company', function ($q) {
            $q->where('status', 1)->where('deleted_at',null);
        });
        $camp->when($request->nationality_id, function ($q) use ($request) {
            return $q->where('nationality_id', $request->nationality_id);
        });
        $camp->when($request->religion, function ($q) use ($request) {
            return $q->where('religion', $request->religion);
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
        
    });
        $camp = $camp->get();
        return NatonalityResource::collection($camp);
    }
    public function search(Request $request)
    {
        // return($request);
        $camp = Nationality::query()->has('worker')->whereHas('worker', function ($camp) use ($request)  {
            $camp->where('is_show',1);
           $camp->has('company')->whereHas('company', function ($q) {
            $q->where('status', 1)->where('deleted_at',null);
        });
        $camp->when($request->key, function ($q) use ($request) {
            return $q->where('name','like','%'.$request->key.'%');
        });
    
    });
        $camp = $camp->get();
        return NatonalityResource::collection($camp);
    }
    public function contact()
    {
        // dd(Social::first());
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
                    'customer_support' =>'test',
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
                    'cities'=>get_city_ar(),
                    'languages'=>get_language(),

                    'natonality'=> NatonalityResource::collection(Nationality::get())
                    
                ]
            ]
        ];
    }
    public function new_login(Request $request){
        $user = Client::where('phone',$request->phone)->first();
        if($user){
        $user->otp = generateNumber();
        $user->save();
            return $this->sendResponse( $user->otp, trans('user login'));
        }else{
            $user = new Client();
            $user->phone = $request->phone;
            $user->otp = generateNumber();
            $user->save();
            return $this->sendResponse( $user->otp, trans('user register'));
        }
    }
    public function check_otp_new(Request $request){
        $user = Client::where('phone',$request->phone)->where('otp',$request->otp)->first();
        if($user){
            $user->otp = null;
            $user->save();
            $user['token'] = $user->createToken('Personal Access Token')->accessToken;
            return $this->sendResponse($user, trans('user login'));
        }else{
            return $this->sendErrornew('not found user');
        }
    }
    public function new_login_company(Request $request){
        $user = User::where('phone',$request->phone)->first();
        if($user){
        $user->otp = generateNumber();
        $user->save();
            return $this->sendResponse( $user->otp, trans('company login'));
        }else{
           
            return $this->sendErrornew( trans('not found Company'));
        }
    }
    public function check_otp_new_company(Request $request){
        if($request->otp == null){
            return $this->sendErrornew('you need to pass OTP');
        }
        $user = User::where('phone',$request->phone)->where('otp',$request->otp)->first();
        if($user){
            $user->otp = null;
            $user->save();
            $user['token'] = $user->createToken('Personal Access Token')->accessToken;
            return $this->sendResponse($user, trans('company login'));
        }else{
            return $this->sendErrornew( trans('error OTP'));
        }
    }
    
    public function get_all_worker(){
        $comapny = User::find(auth('company')->id());
        if($comapny->hasRole('Company')){
            $camp = Worker::query()->where('is_show',1)->has('company')->whereHas('company', function ($q) use ($comapny) {
                $q->where('id', $comapny->company->id);
            })->get();
            return WorkerResource::collection($camp);
        }else{
            return $this->sendErrornew('you are not comapny');

        }
     
    }
    public function store_worker(Request $request){
        if(auth('company')->user() == null){
            return $this->sendErrornew('you are not comapny');
        }
        $worker = new Worker();
        $worker->name = $request->name;
        $worker->image = $request->image->store('worker');
        if ($request->video != null) {

            $resizedVideo = cloudinary()->uploadVideo($request->file('video')->getRealPath(), [
                'folder' => 'uploads',
                'transformation' => [
                    'width' => 375,
                    'height' => 650
                ]
            ])->getSecurePath();
            $worker->video = $resizedVideo;
        }
        $worker->nationality_id = $request->nationality_id;
        
        $worker->company_id =  auth('company')->user()->company->id;

        $worker->age = $request->age;
        $worker->experience = $request->experience;
        $worker->in_sa = $request->is_experience_in_sa;
        $worker->language = ($request->language);
        $worker->religion = $request->religion;
        $worker->approve_chiled = $request->approve_chiled;
        $worker->is_coocked = $request->is_coocked;
        $worker->is_quick = $request->is_quick_for_booking;
        $worker->time = $request->time;
        $worker->url_sand = $request->url_sand;
        $worker->city = $request->city;
        $worker->visa_number = $request->visa_number;
        $worker->description_ar = $request->description_ar;
        $worker->description_en = $request->description_en;
        $worker->company_name_external = $request->company_name_external;
        $worker->company_co_register_external = $request->company_co_register_external;
        if(auth('company')->user()->company->status == 1){
            $worker->status =1;
        }else{
            $worker->status =0;
        }
        $worker->save();
        return $this->sendResponse(new WorkerResource($worker), trans('worker created'));
    }
    public function booking_id($id)
    {
        $booking = Booking::where('user_id',auth('client_api')->id())->where('worker_id',$id)->orderBy('id', 'DESC')->first();
        if($booking){
            $result['worker']= new WorkerResource(Worker::find($id));
            $result['order']= new BookingResoure($booking);
            $response = ['success' => true , 'data' => $result, 'message' =>  trans('bookings detiles')];
            return response()->json($response , 200);
        }else{
            return $this->sendErrornew('not found booking');
    
        }

    }
    public  function check_booking($id)
    {
        $last_booking = Booking::where('user_id',auth('client_api')->id())->where('worker_id',$id)->orderBy('id', 'DESC')->first();
        if($last_booking){
            if($last_booking->status == 1){
                $status['id'] = 1;
                $status['status'] = trans('Done');
            }elseif($last_booking->status == 2){
                $status['id'] = 2;
                $status['status'] = trans('in progress order');
            }elseif($last_booking->status == 0){
                $status['id'] = 0;
                $status['status'] = trans('Reject');
            }
            return $this->sendResponse($status, trans('worker created'));
        }else{
            return $this->sendErrornew('not found booking');
        }
    }
    public function request_worker(Request $request)
    {
        $user = auth('client_api')->user();
        if($user == null){
            return $this->sendErrornew('you need to login');

        }
        // return($request);

        $worker = Worker::find($request->worker_id);
       $status= worker_status_id($worker);
        if ($status == 1 ||  $status == 2) {

            $booking = new Booking();
            $booking->order_id = Carbon::now()->timestamp;
            $booking->user_id = auth('client_api')->id();
            $booking->worker_id = $worker->id;
            $booking->company_id = Company::find($worker->company_id)->id;
            $booking->id_number = $request->id_number;
            $booking->name = auth('client_api')->user()->name;
            $booking->DOB = $request->DOB;
            $booking->phone =  auth('client_api')->user()->phone;
            $booking->visa_image = $request->visa_image->store('booking');
            $booking->visa_number = $request->visa_number;
            $booking->status = 2;

            $booking->save();
            $url = route('pdf_view',($booking->id));

            $image = QrCode::format('svg')
            ->size(200)->errorCorrection('H')
            ->generate($url);
        $output_file =  time() . '.svg';
        $file =  Storage::disk('local')->put($output_file, $image);
          $booking->qr_code = $output_file;
          $booking->save();
            // $worker->status = 2;
            // $worker->save();
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
            $bo->user_id = auth('client_api')->id();

            $bo->phone = $request->phone;
            $bo->save();
            $admin = User::role('Admin')->first();
            $data = [
                'id' => $worker->id,
                'name' => $worker->name,
                'url' => route('booking.unavilable.show', $worker->id),
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
    
    public function count_vist(){
        $general = General::where('key','visitor')->first();
        $general->value +=1;
        $general->save();
        return $this->sendResponse($general->value, trans('add visitor'));
    }
    public function city(){
        $array = array();
        foreach(get_city_ar() as $city){
            array_push($array,$city);
        }
        return  ['data'=>get_city_ar()];
    
    }
    public function register(Request $request){
        $client = Client::where('phone',$request->phone)->first();
        if($client){
            return $this->sendErrornew('this phone alredy in this system');
        }else{
            $client = new Client();
            $client->phone = $request->phone;
            $client->name = $request->name;
            $client->otp = generateNumber();
            $client->password = Hash::make($request->password) ;
            $client->save();
            return $this->sendResponse(   $client, trans('Register success'));
        }
    }
    public function login(Request $request){
        $client = Client::where('phone',$request->phone)->first();
        if($client){
            if($client->is_verify == 0){
                return $this->sendErrornew('you need to verfiy your account');

            }
            if(Hash::check($request->password, $client->password)) {

                 $res['phone']= $client->phone;
                 $res['name']= $client->name;
                 $res['token']=$client->createToken('Personal Access Token')->accessToken;
                return $this->sendResponse(   $res, trans('Register success'));


            } else {
                return $this->sendErrornew('Your password not matched in our records');
            }
        }else{
            return $this->sendErrornew('not found user');

        }
    }
    public function check_otp(Request $request){
        $client = Client::where('otp',$request->otp)->first();
        if($client){
            $client ->otp = null;
            $client->is_verify = 1;
            $client->save();
        
            $res['data']['phone']= $client->phone;
            $res['data']['name']= $client->name;
            $res['data']['token']=$client->createToken('Personal Access Token')->accessToken;
            return $this->sendResponse($client, trans('OTP successfully'));

        }else{
            return $this->sendErrornew('Not found Otp');
        }

    }
    public function resend_otp(Request $request){
        $client = Client::where('phone',$request->phone)->first();
        if($client){
           $client->otp = generateNumber();
           $client->save();
           return $client;
        }else{
            return $this->sendErrornew('Not found user');
        }

    }
    public function my_order(){
        $user = auth('client_api')->user();
        if($user == null){
            return $this->sendErrornew('you need to login');

        }
        $client = Client::find(auth('client_api')->id());
        $booking = Booking::where('user_id',auth('client_api')->id())->get();
        return $this->sendResponse(BookingResoure::collection($booking),'booking');

    }
    public  function my_order_not_avilable()
    {
        $user = auth('client_api')->user();
        if($user == null){
            return $this->sendErrornew('you need to login');

        }
        $booking = BusyWorker::where('user_id',auth('client_api')->id())->get();
        return $this->sendResponse(BusyBookingResoure::collection($booking),'booking busy');

        
    }
    public function delete_my_order($id){
        $booking = Booking::find($id);
        if(!$booking){
            return $this->sendErrornew('not found booking');
        }
        if($booking->status == 1){
            return $this->sendErrornew('The request cannot be deleted because the request is accepted');
        }
        $booking->delete();
        return $this->sendResponse('deleted','booking deleted');
    }
    public function delete_my_order_unavilable($id){
        $booking = BusyWorker::find($id);
        if(!$booking){
            return $this->sendErrornew('not found booking');
        }
        $booking->delete();
        return $this->sendResponse('deleted','booking unavilable deleted');
    }
    public  function logout()
    {
        $user = auth('client_api')->user();
        if($user == null){
            return $this->sendErrornew('you need to login');

        }
        $user->tokens->each(function ($token, $key) {

            $token->delete();
        });
        $user->save();
        return $this->sendResponse('logout','Logout susscefuly');


    }
    public function update_profile(Request $request)
    {
        $user = auth('client_api')->user();
        if($user == null){
            return $this->sendErrornew('you need to login');
        }
        $userr = Client::where('phone',$request->phone)->where('id','!=',$user->id)->first();
        if($userr){
            return $this->sendErrornew('Phone number already exists'); 
        }
        $user->name = $request->name;
        
        $user->save();
        return $this->sendResponse($user,'update profile');
    }
    public function my_profile()
    {
        $user = auth('client_api')->user();
        if($user == null){
            return $this->sendErrornew('you need to login');
        }
        
        return $this->sendResponse($user,'update profile');
    }

}
