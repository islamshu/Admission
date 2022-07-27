<?php

namespace App\Http\Controllers;

use App\Company;
use App\Exports\WorkerExport;
use App\Nationality;
use App\Worker;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $all_nat = Nationality::has('worker')->get();
        $natonality = Nationality::query()->has('worker');
        $natonality->when($request->status != null, function ($q) use ($request) {
            $q->has('worker')->whereHas('worker', function ($q) use ($request) {

                $q->where('status', $request->status);
            });
        });
        $natonality->when($request->natonality_id != null, function ($q) use ($request) {
            $q->has('worker')->whereHas('worker', function ($q) use ($request) {

                $q->where('natonality_id', $request->natonality_id);
            });
        });


        if (auth()->user()->hasRole('Admin')) {
            $natonality->when($request->status != null, function ($q) use ($request) {
                $q->has('worker')->whereHas('worker', function ($q) use ($request) {

                    $q->where('status', $request->status);
                });
            });
            $natonality->when($request->nationality_id != null, function ($q) use ($request) {
                $q->has('worker')->whereHas('worker', function ($q) use ($request) {

                    $q->where('nationality_id', $request->nationality_id);
                });
            });
            $natonality =  $natonality->get();
            return view('dashboard.worker.index')->with('request', $request)->with('natonality', $natonality)->with('all_nat', $all_nat);
        } else {
            $natonality->has('worker')->whereHas('worker', function ($q) use ($request) {

                $q->where('company_id', auth()->user()->company->id);
            });
            $natonality->when($request->status != null, function ($q) use ($request) {
                $q->has('worker')->whereHas('worker', function ($q) use ($request) {

                    $q->where('status', $request->status);
                });
            });
            $natonality->when($request->nationality_id != null, function ($q) use ($request) {
                $q->has('worker')->whereHas('worker', function ($q) use ($request) {

                    $q->where('nationality_id', $request->nationality_id);
                });
            });
            $natonality =  $natonality->get();

            return view('dashboard.worker.index')->with('request', $request)->with('natonality', $natonality)->with('all_nat', $all_nat);
        }
    }
    public function update_status_worker(Request $request)
    {
        $worker = Worker::find($request->worker_id);
        $worker->status = $request->status;
        if($request->status == 1){
            $worker->is_quick = 1;
            $worker->time =null;
            $worker->save();
        }elseif($request->status == 2){
            $worker->is_quick = 0;
            $worker->time =1;
            $worker->save();
        }
        $worker->save();
        return response()->json(['status' => true]);
    }
    public function update_month_worker(Request $request)
    {
        $worker = Worker::findOrFail($request->worker_id);
        $worker->time = $request->time;
        $worker->save();
    
        return response()->json(['message' => 'Worker time updated successfully.']);
    }
    public function updateStatus(Request $request)
{
    $worker = Worker::findOrFail($request->worker_id);
    $worker->is_show = $request->status;
    $worker->save();

    return response()->json(['message' => 'Worker status updated successfully.']);
}

    public function create()
    {
        if (auth()->user()->hasRole('Admin')) {
            return view('dashboard.worker.create')->with('natonality', Nationality::get())->with('comapnys', Company::where('status', 1)->get());
        } else {
            return view('dashboard.worker.create')->with('natonality', Nationality::get());
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
        if (auth()->user()->HasRole('Admin')) {
            $worker->company_id = $request->company_id;
        } else {
            $company = Company::where('user_id', auth()->user()->id)->first();
            $worker->company_id =  $company->id;
        }
        $worker->age = $request->age;
        $worker->experience = $request->experience;
        $worker->in_sa = $request->in_sa;
        $worker->language = json_encode($request->language);
        $worker->religion = $request->religion;
        $worker->approve_chiled = $request->approve_chiled;
        $worker->is_coocked = $request->is_coocked;
        $worker->is_quick = $request->is_quick;
        $worker->time = $request->time;
        $worker->url_sand = $request->url_sand;
        $worker->city = $request->city;
        $worker->visa_number = $request->visa_number;
        $worker->description_ar = $request->description_ar;
        $worker->description_en = $request->description_en;
        $worker->company_name_external = $request->company_name_external;
        $worker->company_co_register_external = $request->company_co_register_external;
        $worker->save();
        return redirect()->route('worker.index')->with(['success' => trans('Addedd successfully ')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function downloadPDF(Request $request)
    {
        $worker = Worker::query();
        $worker->when($request->status != null, function ($q) use ($request) {
            $q->where('status', $request->status);
        });
        $worker->when($request->nationality_id != null, function ($q) use ($request) {
            $q->where('nationality_id', $request->nationality_id);
        });
        if (auth()->user()->HasRole('Admin')) {
            $workers =  $worker->get();
        } else {
            $workers = $worker->where('company_id', auth()->user()->company->id)->get();
        }
        // return view('dashboard.worker.pdf', compact('workers'));
        $pdf = PDF::loadView('dashboard.worker.pdf', compact('workers'));
        return $pdf->download('workers.pdf');
    }
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

        if (auth()->user()->hasRole('Admin')) {
            return view('dashboard.worker.edit')->with('worker', $worker)->with('natonality', Nationality::get())->with('comapnys', Company::where('status', 1)->get());
        } else {
            return view('dashboard.worker.edit')->with('worker', $worker)->with('natonality', Nationality::get());
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
        if ($request->image != null) {
            $worker->image = $request->image->store('worker');
        }
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
        if (auth()->user()->HasRole('Admin')) {
            $worker->company_id = $request->company_id;
        } else {
            $company = Company::where('user_id', auth()->user()->id)->first();
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
        $worker->city = $request->city;
        $worker->visa_number = $request->visa_number;
        $worker->description_ar = $request->description_ar;
        $worker->description_en = $request->description_en;
        $worker->company_name_external = $request->company_name_external;
        $worker->company_co_register_external = $request->company_co_register_external;
        $worker->save();
        return redirect()->route('worker.index')->with(['success' => trans('Updated successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $worker = Worker::find($id);
        $worker->delete();
        return redirect()->route('worker.index')->with(['success' => trans('Deleted successfully')]);
    }
    public function export(Request $request)
    {
        return Excel::download(new WorkerExport($request), 'workers.xlsx');
    }
    public function get_one_pdf($id){
        $worker = Worker::find($id);
        $pdf = PDF::loadView('dashboard.worker.pdf_one', compact('worker'));
        return $pdf->download('workers.pdf');

    }
}
