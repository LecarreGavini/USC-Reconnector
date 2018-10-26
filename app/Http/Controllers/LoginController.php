<?php

namespace App\Http\Controllers;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{

    public function index(){
       
        return view('authenticate.landingpage');
    }
	public function doLogin(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            if(auth()->user()->userStatus == 'Approved' && auth()->user()->userType != 'Admin'){
                return redirect(route('home'));
            }else if(auth()->user()->userStatus == 'Approved' && auth()->user()->userType == 'Admin'){
                return redirect(route('admins'));
            }else if(auth()->user()->userStatus == 'Pending'){
                // dd("error Pending");
                return $this->logout()->with('alert','Your access request is still Pending you will be notified via email');  
            }else if(auth()->user()->userStatus == 'Denied'){
                // dd("error Denied");
                return $this->logout()->with('alert','Your access request has been Denied');  
            }else{
                // dd("error uknown");
                // return $this->logout()->with('success', ['your message,here']);  
            }

        }

        return redirect()->route('login')->withErrors(['password' => 'Incorrect Password']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
    
}
