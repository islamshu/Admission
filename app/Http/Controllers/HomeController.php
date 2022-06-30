<?php

namespace App\Http\Controllers;

use App\General;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect()->route('dashboard');
        // return view('home');
    }
    public function show_translate($lang)
    {
        $language = $lang;

        return view('dashboard.language_view_en', compact('language'));
    }
    public function general(){
        return view('dashboard.general');
    }
 
    public function store(Request $request)
    {
        if($request->hasFile('general_file')){
            foreach ($request->file('general_file') as $name => $value) {
                if($value == null){
                    continue;
                }
                General::setValue($name, $value->store('general'));
            }
        }

        foreach ($request->input('general') as $name => $value){
            if($value == null){
                continue;
            }
            General::setValue($name, $value);
        }

        session()->flash('success', 'تم تحديث البيانات بنجاح');
        return redirect()->back();
    }
    public function notification($id){
      $not = DB::table('notifications')->where('id',$id)->first();
      $not->read_at = Carbon::now();
      $not->save();
      return redirect($not->data['url']);
        
    }
    public function key_value_store(Request $request)
    {
        $data = openJSONFile($request->id);
        foreach ($request->key as $key => $key) {
            $data[$key] = $request->key[$key];
        }
        saveJSONFile($request->id, $data);
        return back();
    }
}
