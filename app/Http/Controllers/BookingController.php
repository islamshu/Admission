<?php

namespace App\Http\Controllers;

use App\Booking;
use App\BusyWorker;
use App\Company;
use App\Exports\BookingExport;
use App\Worker;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class BookingController extends Controller
{
    public function index(){
        if(auth()->user()->HasRole('Admin')){
            return view('dashboard.booking.admin')->with('companies',Company::withCount('booking')->orderBy('id', 'DESC')->get());
        }else{
            return view('dashboard.booking.company')->with('booking',Booking::withTrashed()->where('company_id',auth()->user()->company->id)->orderBy('id', 'DESC')->get());
        }
    }
    public function booking_clinet(Request $request ,$id){
        $booking = Booking::query()->withTrashed()->where('user_id',$id);
        $booking->when($request->status,function ($q) use($request){
        $q->where('status',$request->status);
        });
        $booking->when($request->date,function ($q) use($request){
            
            $q->whereBetween('created_at', [$request->date .' 00:00:00', $request->date .' 23:59:59']);
            });
    
            $booking =$booking->orderBy('id', 'DESC')->get();

           return view('dashboard.booking.company')->with('booking',$booking)->with('request',$request);
    }
    public function index_all(Request $request)
    {
        $booking = Booking::query()->withTrashed();
        $booking->when($request->status,function ($q) use($request){
        $q->where('status',$request->status);
        });
        $booking->when($request->date,function ($q) use($request){
            
            $q->whereBetween('created_at', [$request->date .' 00:00:00', $request->date .' 23:59:59']);
            });
        if(auth()->user()->HasRole('Admin')){
    
            $booking =$booking->orderBy('id', 'DESC')->get();

           return view('dashboard.booking.company')->with('booking',$booking)->with('request',$request);

    }else{
        $booking =$booking->where('company_id',auth()->user()->company->id)->orderBy('id', 'DESC')->get();

           return view('dashboard.booking.company')->with('booking',$booking)->with('request',$request);

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
    public function get_booking_company(Request $request,$id)
    {
        $company = Company::find($id);
        $booking = Booking::query()->withTrashed();
        $booking->when($request->status,function ($q) use($request){
        $q->where('status',$request->status);
        });
        $booking->when($request->date,function ($q) use($request){
            
            $q->whereBetween('created_at', [$request->date .' 00:00:00', $request->date .' 23:59:59']);
            });
            $booking =$booking->where('company_id',$id)->orderBy('id', 'DESC')->get();

        return view('dashboard.booking.company')->with('company',$company)->with('booking',$booking)->with('request',$request);
    }
    public function export(Request $request) 
    {
        return Excel::download(new BookingExport($request), 'booking.xlsx');
    
    }
    public function downloadPDF(Request $request)
    {
        $booking = Booking::query();
        $booking->when($request->status != null, function ($q) use ($request) {
            $q->where('status', $request->status);
        });
        $booking->when($request->date != null, function ($q) use ($request) {
            $q->whereBetween('created_at', [$this->request->date .' 00:00:00', $this->request->date .' 23:59:59']);
        });
        if (auth()->user()->HasRole('Admin')) {
            $bookings =  $booking->get();
        } else {
            $bookings = $booking->where('company_id', auth()->user()->company->id)->get();
        }
        // return view('dashboard.worker.pdf', compact('workers'));
        $pdf = PDF::loadView('dashboard.booking.pdf', compact('bookings'));
        return $pdf->download('booking.pdf');
    }
    public function pdf_view($id){
      $booking = Booking::find($id);  
      $pdf = PDF::loadView('dashboard.booking.pdf_one', compact('booking'));
      return $pdf->download('booking.pdf');
    }
}
