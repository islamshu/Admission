<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Company;
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
