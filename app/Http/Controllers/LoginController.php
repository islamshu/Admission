<?php 
namespace App\Http\Controllers\Admin\Auth;

use App\Events\RoomCheckInCheckOutStatusRemove;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class LoginController extends Controller
{
    public function show_login_form(Request $request)
    {   
    	return view('login.login');
    }

    public function process_login(Request $request)
    {
    	$check = 0;

        $request->validate([
            'mobile_number' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->except(['_token']);

        $user = User::where('phone',$request->mobile_number)->first();
        
        if($user){
            $check = 1;
        }else{
            $check = 0;
        }
        if($check == 1)
        {
            if (auth()->attempt($credentials)) {

            return redirect()->route('dashboard');

            }else{
                $this->sendFailedLoginResponse('message', 'Your password not matched in our records');
                return redirect()->back();
            }
        }else
        {
           $this->sendFailedLoginResponse('message', 'Your phone number is not matched in our records');

           return redirect()->back();
        }

    }

    public function sendFailedLoginResponse(string $key = null, string $message = null)
    {
        session()->flash( $key, $message );
    }
}