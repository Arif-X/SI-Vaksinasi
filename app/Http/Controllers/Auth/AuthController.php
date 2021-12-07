<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\Mail\SigninEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class AuthController extends Controller
{
    /**
     * Processes the login form
     *
     * @param \Illuminate\Http\Request $request
     * @return redirect
     **/
    public function login(Request $request)
    {
    	$user = User::where(
    		'email', $request->post('email')
    	)->first();

        if(!empty($user)){
            $url = URL::temporarySignedRoute(
                'sign-in',
                now()->addMinutes(30),
                ['user' => $user->id]
            );
            Mail::send(new SigninEmail($user, $url));
            return back()->with('success', 'Email berhasil dikirim');
        } else {
            return back()->with('error', 'Gagal mengirim email karena email tersebut belum terdaftar');
        }	
    }


    /**
     * Processes the actual login
     *
     * @param \Illuminate\Http\Request $request
     * @return redirect
     **/
    public function signIn(Request $request)
    {
    	if (!$request->hasValidSignature()) {
    		abort(401);
    	}

    	$user = User::findOrFail($request->user);
    	Auth::login($user);

    	return redirect('/home');
    }

    /**
     * Processes the logout
     *
     * @param \Illuminate\Http\Request $request
     * @return redirect
     **/
    public function logout(Request $request)
    {
    	Auth::logout();
    	return redirect('/');
    }
}
