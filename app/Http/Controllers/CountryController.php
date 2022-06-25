<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index(){
        return view('dashboard.country.index')->with('countries',Country::get());
    }
    public function create()
    {
        return view('dashboard.country.create');
    }
    public function store(Request $request)
    {
      
        $request->validate([
            'callingCodes' => 'required',
            'nativeName' => 'required|string|min:3',
            'name' => 'required|string|min:3',
            'lat' => 'required',
            'lng' => 'required',
            'flag' => 'required',
            'alpha2Code' => 'required',
            'alpha3Code' => 'required',


        ]);
        
            $new_country = new Country();
            $new_country->country_code = $request->callingCodes;
            $new_country->country_name_ar = $request->nativeName;
            $new_country->country_name_en = $request->name;
            $new_country->lat = $request->lat;
            $new_country->lng = $request->lng;
            $new_country->flag = $request->flag;
            $new_country->alph2code = $request->alpha2Code;
            $new_country->alph3code = $request->alpha3Code;
            $new_country->save();
            return redirect()->route('country.index')->with(['success'=>'add successfully']);
    }
    public function destroy($id)
    {
        $country = Country::find($id);
        $country->delete();
        return redirect()->route('country.index')->with(['success'=>'deleted successfully']);

    }
}
