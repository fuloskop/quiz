<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function checklogin(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required|min:5'
        ]);

        $userdata = $request->only('email', 'password');

        if (auth()->attempt($userdata)) {
            // Authentication passed...
            return redirect()->route('home');
        }else{
            return back()->withErrors('E-mail veya şifre yanlış!');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }

    public function passforgot() {
        return view('auth.forgot-password');
    }

    public function passforgotwithrequest(Request $request) {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->withSuccess('Email başarıyla gönderildi.')
            : back()->withErrors(['email' => __($status)]);
    }

    public function passresetwithtoken($token,Request $request) {
        return view('auth.reset-password', ['token' => $token,'email'=>$request->email]);
    }

    public function passreset(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:5',
        ]);

        $user = User::where('email',$request->email)->first();
        //$user = User::find();

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );
        if($status == Password::PASSWORD_RESET){
            return redirect()->route('login')->with('status', __($status));
        }else{
            return  back()->withErrors(['email' => [__($status)]]);
        }

    }
}
