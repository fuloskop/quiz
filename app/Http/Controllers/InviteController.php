<?php

namespace App\Http\Controllers;

use App\Models\Invite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InviteController extends Controller
{
    public function index()
    {

        $Invites = Invite::orderByRaw("-invite_finished_at",'DESC')->where('kurum_id', '=', Auth::user()->kurum_id)->paginate(10);

        return view('invites.index', compact('Invites'));
    }

    public function create()
    {
        return view('invites.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'nullable|date|after:' . now(),
        ]);

        $isnotuniqe=true;
        while($isnotuniqe){
            $uniqe_id=bin2hex(random_bytes(10));
            if(Invite::where('uniqe_id', $uniqe_id)->first()==null){
                $isnotuniqe=false;
            }

        }

        Invite::Create([
            'kurum_id' => Auth::user()->kurum_id,
            'user_id' => Auth::user()->id,
            'invite_finished_at' => $request->date,
            'uniqe_id' => $uniqe_id,
        ]);

        return redirect()->route('invite.index')->with('success', 'Başarılı bir şekilde eklendi.');
    }

    public function destroy(Invite $invite)
    {
        $invite->delete();

        return redirect()->route('invite.index')->with('success', 'Başarılı bir şekilde soru silindi.');
    }
}
