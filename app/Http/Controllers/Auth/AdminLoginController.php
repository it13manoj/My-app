<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdminLoginController extends Controller
{

	public function __construct()
	{
		$this->middleware('guest:admin');
        $this->admin_prefix = "admin";
        $this->employer_prefix= "employer";
        $this->candidate_prefix = "candidate";
        $this->manager_prefix = "manager";
	}

    public function showLoginForm(){
    	return view('auth.admin-login');
    }

    public function login(Request $request){
    	//validate the form data
    	$this->validate($request,[
    		'email'=>'required|email',
    		'password'=>'required'
    	]);
        //attemp to log the user in
    	if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password],$request->remember))
    	{
    		//if successful, then redirect to their intended location
    		return redirect()->intended(route($this->admin_prefix.'.dashboard'));
    	}

    	//if unsuccessful the redirect back to the login page with form data
    	return redirect()->back()->withInput($request->only('email','remember'));
    }
}
