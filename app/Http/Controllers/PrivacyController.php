<?php

namespace App\Http\Controllers;

use App\Privacy;
use Illuminate\Http\Request;

class PrivacyController extends Controller
{
    public function index()
    {
        return view('dashboard.pages.privacy')->with('privacy',Privacy::orderBy('sort','asc')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update_sort(Request $request)
    {
        if($request->has('ids')){
            $arr = explode(',',$request->input('ids'));
            foreach($arr as $sortOrder => $id){
                $menu = Privacy::find($id); 
                $menu->sort = $sortOrder;
                $menu->update(['sort'=>$sortOrder]);
            }
            return ['success'=>true,'message'=>'Updated'];
        }
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        // dd(Privacy::count() +1);
        $page = new Privacy();
        $page->title_ar = $request->title_ar;
        $page->title_en = $request->title_en;
        $page->body_ar = $request->body_ar;
        $page->body_en = $request->body_en;
        $page->sort = Privacy::count() +1;
        $page->save();
        return redirect()->back()->with(['success'=>trans('Added Succeefully')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Privacy  $privacy
     * @return \Illuminate\Http\Response
     */
    public function show(Privacy $privacy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Privacy  $privacy
     * @return \Illuminate\Http\Response
     */
    public function edit(Privacy $privacy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Privacy  $privacy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Privacy $privacy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Privacy  $privacy
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $about= Privacy::find($id);
       $about->delete();
       return redirect()->back()->with(['success'=>trans('Deleted Succeefully')]);

    }
}
