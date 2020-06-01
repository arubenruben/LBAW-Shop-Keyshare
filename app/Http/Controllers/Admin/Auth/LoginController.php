<?php

namespace App\Http\Controllers\Admin\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/admin';
    
    public function username()
    {
        return 'username';
    }
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    protected function guard(){
        return Auth::guard('admin');
    }

    public function login(Request $request)
    { 
        if(Auth::guard('admin')->attempt($request->only('username','password'),$request->filled('remember'))){
            //Authentication passed...
            return redirect('/admin');
        }
    
        //Authentication failed...
        return "fail";
    }


}