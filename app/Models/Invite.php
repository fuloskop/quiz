<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    use HasFactory;

    protected $fillable=['kurum_id','user_id','count','invite_finished_at','uniqe_id'];

    protected $dates=['invite_finished_at'];

    public function checkinvite($invitecode)
    {
        if(Invite::where('uniqe_id', $invitecode )->firstOrFail()){
            return true;
        }
        return false;
    }

    public function Kurum()
    {// 'App\Models\User'
        return $this->belongsTo(Kurum::class);// git push test
    }
    public function User()
    {// 'App\Models\Quiz'
        return $this->belongsTo(User::class);
    }
}
