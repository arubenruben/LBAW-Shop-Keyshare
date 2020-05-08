<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    /**
     * Create a new controller instance.
     *
     * @return void
*/
    public function __construct()
    {
        $this->redirectTo = url()->previous();
        $this->middleware('guest', ['except' => 'logout']);
    }


    public function getUser() {
        return $this->user();
    }

    public function home() {
        return redirect('login');
    }

    public function username(){
        return 'username';
    }

    public function loggedOut(Request $request)
    {
        return redirect('/');
    }

    public function redirectToProvider() {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback() {
        try {
            $user = Socialite::driver('google')->stateless()->user();
        } catch (\Exception $e) {
            return redirect('/');
        }
        
        $existingUser = User::where('email', $user->email)->first();

        if($existingUser){
            // log them in
            auth()->login($existingUser);
            return redirect()->to('/');
        }
    }
}