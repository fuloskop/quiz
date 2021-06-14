<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {

        return view('profile');
    }

    public function passchange(Request $request)
    {
        $this->validate($request,[
            'old_pass' => 'required|min:5',
            'password' => 'required|confirmed|min:5'
        ]);


        if (Hash::check($request->old_pass , auth()->user()->password)) {
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request->password);
            $user->save();
            return back()->with('success', 'Başarılı bir şekilde şifreniz güncellendi.');
        }

        return back()->with('error', 'Şifrenizi yanlış girdiniz. Lütfen tekrar deneyin');
    }
}
