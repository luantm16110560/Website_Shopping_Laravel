<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Illuminate\Support\Facades\Auth;
use App\User; 
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();
            $finduser = User::where('provider_id', $user->id)->first();
            if($finduser){
                Auth::login($finduser);
                return redirect('/home');
            }else{
                $us = User::where('email', $user->email)->first();
                if($us){
                    Auth::login($us);
                    return redirect('/home');
                }
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' =>0,
                    'provider' => 'google',
                    'status' =>1,
                    'provider_id'=> $user->id
                ]);

                Auth::login($newUser);

                return redirect()->back();
            }

        } catch (Exception $e) {
            return redirect('auth/google');
        }
    }

    //login with fb
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
  
    public function handleFacebookCallback()
    {
        try {

            $getInfo = Socialite::driver('facebook')->user(); 
            echo('<br>');
         
            $user = User::where('provider_id', $getInfo->id)->first();

            if($user){

                Auth::login($user);

                 return redirect('/home');

            }else{
                $newUser = User::create([
                    'name'     => $getInfo->name,
                    'email'    => $getInfo->email,
                    'provider' => 'facebook',
                    'role' =>0,
                    'status' =>1,
                    'provider_id' => $getInfo->id
                ]);

                Auth::login($newUser);

                //return redirect()->back();
            }

        } catch (Exception $e) {
           // return redirect()->to('/home');
           //return redirect('auth/facebook');
           echo('cccc');
           //echo('fb login error');
        }
    }
    
 
}