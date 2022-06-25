<?php

namespace App\Http\Controllers;

use App\Nationality;
use Illuminate\Http\Request;

class NationalityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.nationality.index')->with('natis',Nationality::get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.nationality.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nationality = Nationality::create([
            'name'=>['ar'=>$request->name_ar,'en'=>$request->name_en]
        ]);
        return redirect()->route('nationalities.index')->with(['success'=>'added successfully']);
    }
    public function store_ajax(Request $request)
    {
        $nationality = Nationality::create([
            'name'=>['ar'=>$request->name_ar,'en'=>$request->name_en]
        ]);
        if(get_lang()=='ar'){
            $name = $request->name_ar;
        }else{
            $name = $request->name_en;
        }
        return response()->json(['id'=>$nationality->id,'name'=>$name]);

    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Nationality  $nationality
     * @return \Illuminate\Http\Response
     */
    public function get_natonlity_edit(Request $request){
        $nationality = Nationality::find($request->id);
        return view('dashboard.nationality.edit')->with('nat',$nationality);
    }
    public function show(Nationality $nationality)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Nationality  $nationality
     * @return \Illuminate\Http\Response
     */
    public function edit(Nationality $nationality)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Nationality  $nationality
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $nationality = Nationality::find($id);
        $nationality->update([
            'name'=>['ar'=>$request->name_ar,'en'=>$request->name_en]
        ]);
        return redirect()->route('nationalities.index')->with(['success'=>'Edit successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Nationality  $nationality
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nationality $nationality)
    {
        //
    }
}
