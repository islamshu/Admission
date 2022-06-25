<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy('id', 'DESC')->get();
        return view('dashboard.users.index', compact('data'));
            
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('dashboard.users.create', compact('roles'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required',
            'phone' => 'required|unique:users,phone',
        ]);
        $input = $request->all();
      
        $input['password'] = Hash::make($request->password);
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function logout(){
        auth()->logout();
        return redirect()->route('get_login');
    }
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        return view('dashboard.users.edit', compact('user', 'roles', 'userRole'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_profile()
    {
        return view('dashboard.employee.edit_profile');
    }
    public function update_profile(Request $request){
        $user = auth()->user();
    
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email,'.$user->id,
            'phone'=>'required|unique:users,phone,'.$user->id,
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if($request->password != null){
            $user->password = bcrypt($request->password);
        }
        $user->save();
        if($user->hasRole('Company')){
            $compnay = Company::where('user_id',$user->id)->first();
            $compnay->email = $request->email;
            $compnay->phone = $request->phone;
            $compnay->save();
        }
      

        return redirect()->back()->with(['success'=>'تمت التعديل بنجاح']);
    }
    public function dashboard()
    {
        return view('dashboard.index');

    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'roles' => 'required',
            'phone' => 'required|unique:users,phone,' . $id,

        ]);
        $input = $request->except(['password']);
        if($request->password != null){
            
            $input['password'] = Hash::make($request->password);
        }
      
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($request->input('roles'));
        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
    public function show_login_form(Request $request)
    {   
    	return view('login.login');
    }

    public function process_login(Request $request)
    {
    	$check = 0;
        

        $request->validate([
            'phone' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->except(['_token']);

        $user = User::where('phone',$request->phone)->first();
        
        
        if($user){
            $check = 1;
            if($user->company != null){
                if($user->company->status == 0 ){
                 return redirect()->back()->with(['error'=>'Your data is still being checked']);
                }
            }
        }else{
            $check = 0;
        }
        if($check == 1)
        {
            if (auth()->attempt($credentials)) {
            return redirect()->route('dashboard');

            }else{
                // $this->sendFailedLoginResponse('message', 'Your password not matched in our records');
                return redirect()->back()->with(['error'=>'Your password not matched in our records']);
            }
        }else
        {
            return redirect()->back()->with(['error'=>'Your phone number is not matched in our records']);


        }

    }

    public function sendFailedLoginResponse(string $key = null, string $message = null)
    {
        session()->flash( $key, $message );
    }
}
