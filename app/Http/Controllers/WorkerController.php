<?php

namespace App\Http\Controllers;

use App\Company;
use App\Nationality;
use App\Worker;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->hasRole('Admin')){
        return view('dashboard.worker.index')->with('natonality',Nationality::has('worker')->get());
        }else{
            return view('dashboard.worker.index')->with('natonality',Nationality::has('worker')->whereHas('worker', function ($q)  {
                $q->where('company_id',auth()->user()->company->id);
            }) ->get());
               
 
        }
    }
    public function update_status_worker(Request $request){
        $worker = Worker::find($request->worker_id);
        $worker->status = $request->status ;
        $worker->save();
        return response()->json(['status'=>true]);

    }
 
    public function create()
    {
        if(auth()->user()->hasRole('Admin')){
            return view('dashboard.worker.create')->with('natonality',Nationality::get())->with('comapnys',Company::where('status',1)->get());
        }else{
            return view('dashboard.worker.create')->with('natonality',Nationality::get());
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $worker = new Worker();
        $worker->name = $request->name;
        $worker->image = $request->image->store('worker');
        $worker->nationality_id = $request->nationality_id;
        if(auth()->user()->HasRole('Admin')){
            $worker->company_id = $request->company_id;
        }else{
            $company = Company::where('user_id',auth()->user()->id)->first();
            $worker->company_id =  $company->id;
        }
        $worker->age = $request->age;
        $worker->experience = $request->experience;
        $worker->in_sa = $request->in_sa;
        $worker->language = $request->language;
        $worker->religion = $request->religion;
        $worker->approve_chiled = $request->approve_chiled;
        $worker->is_coocked = $request->is_coocked;
        $worker->is_quick = $request->is_quick;
        $worker->time = $request->time;
        $worker->url_sand = $request->url_sand;
        $worker->save();
        return redirect()->route('worker.index')->with(['success'=>'Added successfully']);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function show(Worker $worker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $worker = Worker::find($id);
        if(auth()->user()->hasRole('Admin')){
            return view('dashboard.worker.edit')->with('worker',$worker)->with('natonality',Nationality::get())->with('comapnys',Company::where('status',1)->get());
        }else{
            return view('dashboard.worker.edit')->with('worker',$worker)->with('natonality',Nationality::get());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $worker = Worker::find($id);
        $worker->name = $request->name;
        if($request->image != null){
            $worker->image = $request->image->store('worker');
        }
        $worker->nationality_id = $request->nationality_id;
        if(auth()->user()->HasRole('Admin')){
            $worker->company_id = $request->company_id;
        }else{
            $company = Company::where('user_id',auth()->user()->id)->first();
            $worker->company_id =  $company->id;
        }
        $worker->age = $request->age;
        $worker->experience = $request->experience;
        $worker->in_sa = $request->in_sa;
        $worker->language = $request->language;
        $worker->religion = $request->religion;
        $worker->approve_chiled = $request->approve_chiled;
        $worker->is_coocked = $request->is_coocked;
        $worker->is_quick = $request->is_quick;
        $worker->time = $request->time;
        $worker->url_sand = $request->url_sand;
        $worker->save();
        return redirect()->route('worker.index')->with(['success'=>'Edited successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $worker= Worker::find($id);
       $worker->delete();
       return redirect()->route('worker.index')->with(['success'=>'Deleted successfully']);

    }
}
