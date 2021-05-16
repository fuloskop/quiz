<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function checkregister(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|min:3',
            'surname' => 'required|min:2',
            'email'=> 'required|email|unique:users,email',
            'username' => 'required|unique:users,username|min:3',
            'password' => 'required|confirmed|min:5'
        ]);

        User::create([
            'name' => $request->name . " " . $request->surname,
            'username' => $request->username,
            'email'=> $request->email,
            'password' => Hash::make($request->password)
        ]);



        return redirect('login');
    }
}
