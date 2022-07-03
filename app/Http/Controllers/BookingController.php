<?php

namespace App\Http\Controllers;

use App\Booking;
use App\BusyWorker;
use App\Company;
use App\Worker;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(){
        if(auth()->user()->HasRole('Admin')){
            return view('dashboard.booking.admin')->with('companies',Company::withCount('booking')->orderBy('id', 'DESC')->get());
        }else{
            return view('dashboard.booking.company')->with('booking',Booking::withTrashed()->where('company_id',auth()->user()->company->id)->orderBy('id', 'DESC')->get());
        }
    }
    public function unavliable()
    {
       $workers = Worker::has('busy')->get();
       return view('dashboard.booking.unaviable')->with('workers',$workers);
    }
    public function update_status_booked(Request $request){
        $worker = Booking::find($request->booked_id);
        $worker->status = $request->status ;
        $worker->save();
        return response()->json(['status'=>true]);

    }
    
    public function show_unavliable($id)
    {
     $user = BusyWorker::where('worker_id',$id)->get();
     return view('dashboard.booking.show_unav')->with('users',$user)->with('worker_id',$id);

    }
    public function show($id)
    {
       $book= Booking::find($id);
        return view('dashboard.booking.show')->with('booking',$book); 
    }
    public function get_booking_company($id)
    {
        $company = Company::find($id);
        return view('dashboard.booking.company')->with('company',$company)->with('booking',Booking::withTrashed()->where('company_id',$id)->orderBy('id', 'DESC')->get());
    }
}
