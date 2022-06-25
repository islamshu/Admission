<?php

namespace App\Http\Controllers;

use App\Company;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hash;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.company.index')->with('companies',Company::orderBy('id', 'DESC')->get());
    }
    public function updateStatus(Request $request)
    {
        $user = Company::findOrFail($request->company_id);
        $user->status = $request->status;
        $user->save();
    
        return response()->json(['message' => 'User status updated successfully.']);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

  
    public function get_register()
    {
        return view('login.register');
    }
    public function get_compnay_edit(Request $request){
        $company = Company::find($request->id);
        return view('dashboard.company.edit')->with('company',$company);
    }
    public function store(Request $request)
    {   
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email|email|unique:companies,email',
            'phone'=>'required|unique:users',
            'commercial_register'=>'required'
        ]);
        try {
        DB::beginTransaction();
        $user = new User();
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->name = $request->name;
        // $user->show_password = generate_password();
        // $user->password = encrypt(generate_password()) ;
        $user->show_password = '123456789';
        $user->password = Hash::make('123456789') ;
        // $user->otp = generateNumber();
        $user->otp = 1991;
        $user->save();
        $user->assignRole('Company');
        $company = new Company();
        $company->name = $request->name;
        $company->email = $request->email;
        $company->phone = $request->phone;
        $company->co_register = $request->commercial_register;
        $company->image = 'default.png';
        $company->user_id = $user->id;
        $company->save();
        DB::commit();
        return response()->json(['success'=>'the otp send to your phone']);

    } catch(\Exception $exp) {
        DB::rollBack(); // Tell Laravel, "It's not you, it's me. Please don't persist to DB"
        return redirect()->back->with(['error'=>'error occer']);
    }
    }
    public function check_otp(Request $request){
        $request->validate([
            'otp'=>'required',
        ]);
        $user = User::where('otp',$request->otp)->first();
        if($user){
            $user->verify = 1 ;
            $user->otp = null;
            $user->save();
        }
        return response()->json(['success'=>'The data will be verified by the administration and we will contact you']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required',
            'email' => 'required|email|unique:companies,email,' . $id,
            'phone' => 'required|unique:companies,phone,' . $id,
            'commercial_register'=>'required'
        ]);
        $company = Company::find($id);
        $company->name = $request->name;
        $company->email = $request->email;
        $company->phone = $request->phone;
        $company->co_register = $request->commercial_register;
       
        $company->save();
        $user = $company->user;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if($request->password != null){
            $user->password =  Hash::make($request->password);  
        }
        $user->save();
        return response()->json(['success'=>'Updated successfully']);



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id);
        $company->delete();
        return redirect()->route('companies.index')->with(['success'=>'Deleted successfully']);
    }
}
