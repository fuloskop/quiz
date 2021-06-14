<?php

namespace App\Http\Controllers;

use App\Models\Invite;
use Illuminate\Http\Request;
use Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function checkregister(Request $request)
    {
        $this->validate($request,[
            'invite' => 'required|min:10|exists:invites,uniqe_id',
            'name' => 'required|min:3',
            'surname' => 'required|min:2',
            'email'=> 'required|email|unique:users,email',
            'username' => 'required|unique:users,username|min:3',
            'password' => 'required|confirmed|min:5'
        ]);

        $invites = Invite::where('uniqe_id', $request->invite)

            ->orwhere('invite_finished_at', '>=', now())
            ->orWhereNull(['invite_finished_at'])
            ->first();

        $invite = Invite::where(function ($query) use ($request){
            $query->where('uniqe_id', $request->invite);
        })
            ->where(function ($query) use ($request) {
                $query->Where('invite_finished_at', '>=', \Carbon\Carbon::now())
                    ->orWhereNull(['invite_finished_at']);
            })->first();

        if(!isset($invite)){
            return back()->withErrors(['errors' => 'Davet kodu süresi dolmuş']);
        }


        User::create([
            'kurum_id' => $invite->kurum_id,
            'name' => $request->name . " " . $request->surname,
            'username' => $request->username,
            'email'=> $request->email,
            'password' => Hash::make($request->password)
        ]);

        $invite->count = $invite->count+1;
        $invite->save();

        return redirect('login');
    }
}
