<?php

namespace App\Http\Controllers;

use App\Social;
use Illuminate\Http\Request;


class SocialController extends Controller
{
    
    public function index()
    {
        return view('dashboard.pages.social');
    }
    public function store(Request $request)
    {
        if($request->hasFile('general_file')){
            foreach ($request->file('general_file') as $name => $value) {
                if($value == null){
                    continue;
                }
                Social::setValue($name, $value->store('general'));
            }
        }

        foreach ($request->input('general') as $name => $value){
            if($value == null){
                continue;
            }
            Social::setValue($name, $value);
        }

        return redirect()->back()->with(['success'=>trans('Updated successfully')]);
    }
}
